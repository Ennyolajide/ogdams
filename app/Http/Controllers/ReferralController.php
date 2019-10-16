<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ReferralController extends NotificationController
{
    //
    public function addReferrerBonus($user)
    {
        $myReferrer = $user->myReferrer->id;
        $bonus = \config('constants.bonuses.referral');
        $status = $this->creditUserWallet($myReferrer, $bonus);
        $status ? $this->notifyUser($myReferrer, $this->referralBonusNotification($user, $bonus)) : false;
        $status = $status ? $user->update(['first_time_funding' => false]) : false;

        return $status ? $bonus : 0;
    }
}
