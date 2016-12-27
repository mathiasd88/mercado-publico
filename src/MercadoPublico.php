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
     * @return MercadoPublico
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
     * @return MercadoPublico
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
     * @return MercadoPublico
     */
    public function buscarComprador()
    {
        $this->url .= '/Empresas/BuscarComprador';

        return $this;
    }

    /**
     * Obtiene el listado de licitaciones disponibles en la plataforma Mercado Público.
     * 
     * @return MercadoPublico
     */
    public function licitaciones()
    {
        $this->url .= '/licitaciones.json';

        return $this;
    }

    /**
     * Filtro por fecha.
     * 
     * @param  string $fecha
     * @return MercadoPublico
     */
    public function fecha($fecha)
    {
        $this->params['fecha'] = $fecha;

        return $this;
    }

    /**
     * Filtro por código de licitación
     * 
     * @param  string $codigo
     * @return MercadoPublico
     */
    public function codigo($codigo)
    {
        $this->params['codigo'] = $codigo;

        return $this;
    }

    /**
     * Filtro por estado de la licitación
     * 
     * @param  string $estado
     * @return MercadoPublico
     */
    public function estado($estado)
    {
        $estado = strtolower($estado);

        $this->params['estado'] = $estado;

        return $this;
    }

    /**
     * Filtro por organismo
     * 
     * @param  string $organismo
     * @return MercadoPublico
     */
    public function codigoOrganismo($organismo)
    {
        $this->params['CodigoOrganismo'] = $organismo;

        return $this;
    }

    /**
     * Filtro por proveedor
     * 
     * @param  string $proveedor
     * @return MercadoPublico
     */
    public function codigoProveedor($proveedor)
    {
        $this->params['CodigoProveedor'] = $proveedor;

        return $this;
    }
}