<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SaveVoluntario extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public $subject = "Te has registrado al voluntariado Jalisco";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->view('email.confirm_voluntario')
                    ->subject('Te has registrado al voluntariado Jalisco')
                    ->with($this->data);
    }
}
