<?php

namespace App\Http\Controllers;


use App\Bvn;
use App\User;
use App\Charge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_decode;
use Illuminate\Support\Facades\Crypt;


class BvnVerificationController extends PaystackController
{
    //
    protected $modalResponse;
    protected $failureResponse;
    protected $successResponse = 'Airtime to cash request successful <br/> Pls wait while your transaction is been processed';
    protected $insufficientBalanceResponse = 'Insuffient balance, Pls fund your account';


    public function getBvnDetails(){
        return $this->getPaystack('bank/resolve_bvn/'.request()->bvn);
    }

    public function resolveBvnDetails(){
        $charge = Charge::whereService('bvn')->first()->amount;
        $this->validate(request(), ['bvn' => 'required|string|min:8|max:12']);
        if(Auth::user()->balance >= $charge){
            $query = 'bank/resolve_bvn/'.request()->bvn;
            $bvnDetails = json_decode($this->getPaystack($query));
            $bvnDetails = isset($bvnDetails->status) ? $bvnDetails->data : false;
            $user = User::find(Auth::user()->id); $this->debitWallet($charge);
            $otpToken = $bvnDetails ? $this->sendBvnOTp($bvnDetails->mobile) : false;
            $status = $otpToken ?
                $user->bvnDetails->update([
                    'bvn_otp' => $otpToken,
                    'expiry' => Carbon::now()->addMinute(10),
                    'bvn_details' => json_encode($bvnDetails, true),
                ]) : false;

            return redirect(route('user.profile').'#verify')->with(
                $status ? 'otp' : 'notification', $status ? true : $this->clientNotify('Unknown Error',false)
            );
        }
        return redirect(route('user.profile').'#verify')
                ->withNotification($this->clientNotify($this->insufficientBalanceResponse, false));
    }

    /**
     * Send Otp to User's registered BVN Phone Number
     */
    protected function sendBvnOTp($phone){
        $otpToken = rand(102341, 990019);
        $encryptedOtpToken = encrypt($otpToken);
        $sender = config('constants.sms.sender');
        $to = '+'.$this->formatPhoneNumber($phone);
        $content = 'Please use the OTP code: '.$otpToken;
        $content.= ' to complete your bvn verification Expires in 5 minutes';

        return $this->sendSmsViaTwilio($content, $to) ? $encryptedOtpToken : false;
    }

    /**
     * Verify OTP
     */
    public function verifyOtpAndDob(){
        $this->validate(request(), [
            'dob' => 'required|date',
            'otp' => 'required|numeric',
        ]); $user = User::find(Auth::user()->id);
        $bvnDetails = json_decode($user->bvnDetails->bvn_details);
        $otpStatus = decrypt($user->bvnDetails->bvn_otp) == request()->otp;
        $expiryStatus = $user->bvnDetails->expiry >= Carbon::now() ? 'true' : 'false';
        $dobStatus = Carbon::parse($bvnDetails->dob)->format('Y-m-d') === request()->dob;

        if($expiryStatus){
            $update = [
                'bvn_verified' => true,
                'name' => $bvnDetails->first_name.' '.$bvnDetails->last_name
            ];
            $status = $otpStatus && $dobStatus ? $user->update($update) : false;
            $response = $status ? 'Verification succesful' : 'Invalid OTP / Date of Birth';
        }else{
            $status = false;
            $response = 'Expiered OTP (One Time Pin)';
        }

        return redirect(route('user.profile').'#verify')
                ->withNotification($this->clientNotify($response,$status));
    }

}
