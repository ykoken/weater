<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeaterSendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $email;
    protected  $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail,$data)
    {
        $this->email = $mail;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Your Favorite City Weater')
            ->to($this->email)
            ->with(['data'=> $this->data])
            ->view('emails.weater');
    }
}
