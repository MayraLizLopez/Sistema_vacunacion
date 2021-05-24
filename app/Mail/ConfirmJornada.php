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
        $archivo = "{{ asset('public/assets/images/Vacio.pdf') }}";
    }

    /**
     * Método que permite el envió de correos electónicos.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('voluntariado.jalisco@gmail.com', 'Voluntariado Jalisco')
                    ->view('email.ConfirmJornada')
                    //->attach("{{ asset('public/assets/images/Vacio.pdf') }}")
                    ->subject('¡Felicidades has sido seleccionado como voluntario!')
                    ->with($this->data);
    }
}
