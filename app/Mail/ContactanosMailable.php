<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactanosMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    public $correo;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->nombre = $data->nombre;
        $this->correo = $data->correo;
        $this->mensaje = $data->mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactanos');
    }
}
