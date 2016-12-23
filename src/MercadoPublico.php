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
     * Envia la petición para que la API de la plataforma Mercado Público la procese.
     * 
     * @param  string $url
     * @param  array $params
     * @return Json
     */
    public function enviaPeticion($url, $params = [])
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
     * Procesa la respuesta: Si no fue exitosa agrega mensaje y còdigo 203, caso contrario mensaje de Éxito y código 200.
     */
    public function validates()
    {
        if (isset($this->response->Codigo)) {
            $this->status = 203;
            $this->message = $this->response->Mensaje;
        } else {
            $this->status = 200;
            $this->message = 'Éxito';
        }
    }

    /**
     * Busca proveedor por rut de la empresa (debe incluir puntos, guion y digito verificador).
     * 
     * @param  string $name
     * @return Object
     */
    public function buscarProveedor($rut)
    {
        $response = $this->enviaPeticion('/Empresas/BuscarProveedor', ['rutempresaproveedor' => $rut]);

        return $this;
    }

    /**
     * Listado de todos los organismos públicos de la plataforma Mercado Público.
     * 
     * @return Object
     */
    public function buscarComprador()
    {
        $response = $this->enviaPeticion('/Empresas/BuscarComprador');

        return $this;
    }

}