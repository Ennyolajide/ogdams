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
        //$this->logo = '/honeylogo.jpg';
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
        return $this->from('exmaple@test.com', 'Testing 123')
                    ->subject($this->subject)
                    ->view('emails.main');
    }
}
