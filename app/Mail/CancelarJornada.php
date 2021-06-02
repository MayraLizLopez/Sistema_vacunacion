<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelarJornada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Método que permite el envió de correos electónicos.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this;
        $email->from('voluntariado.jalisco@gmail.com', 'Voluntariado Jalisco');
        $email->view('email.CancelarJornada', $email->data);
        $email->subject('¡SEDES CANCELADAS!');
        $email->with($email->data);
        
        return $email;
    }
}
