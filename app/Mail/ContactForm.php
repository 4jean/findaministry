<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $cf;
    public function __construct($cf)
    {
        $this->cf = $cf;
    }

    public function build()
    {
        $data['cf'] = $this->cf;
        return $this->view('emails.contact_form.new_message', $data)
            ->subject('[CF] Mew Message From '.$this->cf['name']);
    }
}
