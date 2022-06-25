<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class ContactFormMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->from([
                'address' => $request->email, 
            ])
            ->to( env('MAIL_FROM_ADDRESS') )
            ->subject( 'Message from website: ' . $request->subject )
            ->view('emails.contact')
            ->with([    
                'contactSubject' => $request->subject,
                'contactEmail' => $request->email,
                'contactMessage' => $request->message
            ]);
        return $this->view('emails.contact');
    }
}
