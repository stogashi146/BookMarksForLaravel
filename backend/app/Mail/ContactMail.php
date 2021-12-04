<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $category, $content)
    {
        $this->email = $email;
        $this->category = $category;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(["email" => $this -> email])
        ->subject("お問い合わせを受け付けました")
        ->view("contact.contact_mail")
        ->with(["email" => $this -> email, "category" => $this -> category, "content" => $this -> content]);
    }
}
