<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $logo;
    public $link;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $link)
    {
        //
        $this->logo = \config('constants.site.url') . '/home/img/logo.jpg';
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(\config('constants.site.emails.sender.noreply'), strtoupper(\config('constants.site.name')))
            ->subject('Password Reset')
            ->view('emails.reset');
    }
}
