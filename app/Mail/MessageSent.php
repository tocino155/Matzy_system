<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSent extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $subject;
    public $modulo;
    public function __construct($titulo,$data,$modulo)
    {
        $this->datos = $data;
        $this->subject = $titulo;
        $this->modulo = $modulo;
    }

    public function build()
    {
        if($this->modulo=="service"){
            return $this->view('Emails.service_new');
        }

        if($this->modulo=="finance"){
            return $this->view('Emails.finance_new');
        }

        if($this->modulo=="catalogos"){
            return $this->view('Emails.catalogos_new');
        }

        
    }
}
