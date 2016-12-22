<?php

namespace Mathiasd88\MercadoPublico;

use GuzzleHttp\Client;

class MercadoPublico
{
    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
        $this->url = 'http://api.mercadopublico.cl/servicios/v1/publico';
    }

    public function isValid()
    {
        $json = file_get_contents($this->url . '/licitaciones.json?ticket=' . $this->ticket);
        
        $response = json_decode($json);
        
        return ($response->Mensaje != 'Ticket no válido.');
    }
}