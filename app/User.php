<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'number', 'password', 'token', 'wallet_id', 'referrer', 'api_token', 'active', 'balance', 'first_time_funding'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function banks()
    {
        return $this->hasMany(Bank::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function myReferrer()
    {
        return $this->hasOne(User::class, 'id', 'referrer');
    }


    /* public function data(){
        return $this->hasMany(Data::class);
    }

    public function airtime2Cash()
    {
        return $this->hasMany(Airtime::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }


 */
}
