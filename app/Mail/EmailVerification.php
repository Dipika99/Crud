<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $user;
	 
    public function __construct($user)
    {
         $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->subject('Email Verify')->markdown('emails.verify',['user'=>$this->user]);
				//return $this->view('emails.verify')->with('user', $this->user);
		//return $this->view('emails.verify');
    }
}
