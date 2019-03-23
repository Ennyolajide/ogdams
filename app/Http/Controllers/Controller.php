<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function notify($notification = null)
    {
        Message::create([
            'user_id' => Auth::user()->id,
            'subject' => $notification['subject'],
            'content' => $notification['content'],
        ]);
    }

    public function naira($amount)
    {
        return '₦'.number_format($amount, 2);
    }

    public function creditWallet($amount, $notification)
    {
        $user = User::find(Auth::user()->id);
        $user->balance = Auth::user()->balance + $amount;
        $user->save();
        $this->notify($notification);
    }

    public function debitWallet($amount, $notification)
    {
        $user = User::find(Auth::user()->id);
        $user->balance = Auth::user()->balance - $amount;
        $user->save();
        $this->notify($notification);
    }
}
