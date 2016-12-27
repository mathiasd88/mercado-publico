<?php

namespace Mathiasd88\MercadoPublico;

use Mathiasd88\MercadoPublico\Helpers\Format;

class MercadoPublico
{
    protected $ticket;

    protected $url;

    protected $params = [];

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
     * @return Json
     */
    public function get()
    {
        $requestUrl = $this->url . '?ticket=' . $this->ticket;

        foreach ($this->params as $key => $value) {
            $requestUrl .= '&' . $key . '=' . $value;
        }

        $json = file_get_contents($requestUrl);

        $response = json_decode($json);

        $this->response = $response;

        $this->validates();

        return $this;
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
        $this->url .= '/Empresas/BuscarProveedor';

        $this->params['rutempresaproveedor'] = $rut;

        return $this;
    }

    /**
     * Listado de todos los organismos públicos de la plataforma Mercado Público.
     * 
     * @return Object
     */
    public function buscarComprador()
    {
        $this->url .= '/Empresas/BuscarComprador';

        return $this;
    }

    /**
     * Obtiene el listado de licitaciones disponibles en la plataforma Mercado Público.
     * 
     * @return Object
     */
    public function licitaciones()
    {
        $this->url .= '/licitaciones.json';

        return $this;
    }

    public function fecha()
    {
        return $this;
    }
}