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
    public $email_account;

    public function __construct($data, $email_account)
    {
        $this->data = $data;
        $this->email_account = $email_account;
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

        $email->from($this->email_account, 'Voluntariado Jalisco');
        $email->view('email.ConfirmJornada');
        $email->subject('¡Felicidades has sido seleccionado como voluntario!');
        $email->with($email->data);
        
        return $email;
    }
}
