<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Enlaces extends Mailable
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['nombreArchivo'] == ""){
            return $this->from('voluntariado.jalisco@gmail.com', 'Voluntariado Jalisco')
                    ->view('email.correoEnlaces')
                    ->subject('Admistrador de voluntariado')
                    ->with($this->data);
        }else{
            return $this->from('voluntariado.jalisco@gmail.com', 'Voluntariado Jalisco')
                    ->view('email.correoEnlaces')
                    ->subject('Admistrador de voluntariado')
                    ->attachData($this->data['archivo'],  $this->data['nombreArchivo'])
                    ->with($this->data);
        }
        
    }
}
