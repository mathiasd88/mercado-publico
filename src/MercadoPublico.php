<?php

namespace Mathiasd88\MercadoPublico;

use Mathiasd88\MercadoPublico\Helpers\Format;

class MercadoPublico
{
    protected $ticket;

    public $status;

    public $response;

    public $message;

    /**
     * Constructor class
     * 
     * @param string $ticket
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
        $this->url = 'http://api.mercadopublico.cl/servicios/v1/publico';
    }

    /**
     * Send a request to the Mercado Publico API
     * 
     * @param  string $url
     * @param  array $params
     * @return Json
     */
    public function sendRequest($url, $params)
    {
        $requestUrl = $this->url . $url . '?ticket=' . $this->ticket;

        foreach ($params as $key => $value) {
            $requestUrl .= '&' . $key . '=' . $value;
        }

        $json = file_get_contents($requestUrl);

        $response = json_decode($json);

        $this->response = $response;

        $this->validates();

        return json_decode($json);
    }

    /**
     * Validates if the response is succesfully
     */
    public function validates()
    {
        if (isset($this->response->Codigo)) {
            $this->status = 203;
            $this->message = $this->response->Mensaje;
        } else {
            $this->status = 200;
            $this->message = 'Success';
        }
    }

    /**
     * Search provider by name
     * 
     * @param  string $name
     * @return Object
     */
    public function findProvider($rut)
    {
        $rut = $this->formatRut($rut);

        $response = $this->sendRequest('/Empresas/BuscarProveedor', ['rutempresaproveedor' => $rut]);

        return $this;
    }

    private function formatRut($rut)
    {
        return $rut;
    }
}