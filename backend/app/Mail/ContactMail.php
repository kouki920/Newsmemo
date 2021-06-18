<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('newsmemo.app@gmail.com')->text('emails.contact')->with([
            'contactGender' => $this->contact->gender,
            'contactAge' => $this->contact->age,
            'contactEmail' => $this->contact->email,
            'contactContent' => $this->contact->content,
        ]);
    }
}
