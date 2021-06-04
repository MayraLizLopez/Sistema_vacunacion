<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestartPassword extends Mailable
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
     * método para enviar correo electrónico con la una contraseña random
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('voluntariado.jalisco@gmail.com', 'Voluntariado Jalisco')
                    ->view('email.restartPass')
                    ->subject('Cambio de contraseña')
                    ->with($this->data);
    }
}