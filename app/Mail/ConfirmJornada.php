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
    //    $img_url = "{{ asset('public/assets/images/isologo_jalisco_v.svg') }}";
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
                    ->subject('¡Felicidades has sido seleccionado como voluntario!')
                    ->with($this->data);
    }
}
