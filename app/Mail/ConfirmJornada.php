<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmJornada extends Mailable
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
     * Método que permite el envió de correos electónicos para las jornadas.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this;

        foreach($email->data['anexos'] as $anexos){
            $email->attachData(base64_decode($anexos->anexo), $anexos->nombre);
        }

        $email->from('voluntariado.jalisco@gmail.com', 'Voluntariado Jalisco');
        $email->view('email.ConfirmJornada');
        $email->subject('¡Felicidades has sido seleccionado como voluntario!');
        $email->with($email->data);
        
        return $email;
    }
}
