<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Main extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $logo;
    public $subject;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $subject = null, $link = null)
    {
        //
        $this->content = $content;
        $this->logo = env('APP_URL') . '/home/img/logo.jpg';
        $this->subject = $subject;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('SITE_EMAIL_SENDER'), strtoupper(env('APP_NAME')))
            ->subject($this->subject)
            ->view('emails.main');
    }
}
