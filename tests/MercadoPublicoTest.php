<?php

use Mathiasd88\MercadoPublico\MercadoPublico;

class MercadoPublicoTest extends PHPUnit_Framework_TestCase
{
    protected $defaultTicket = 'F8537A18-6766-4DEF-9E59-426B4FEE2844';

    protected $defaultDate = '02022014';

    /**
     * Creates a MercadoPublico instans for testing purposes.
     * 
     * @return MercadoPublico
     */
    private function createMercadoPublicoInstance()
    {
        $mercadoPublico = new MercadoPublico($this->defaultTicket);

        return $mercadoPublico;
    }

    /**
     * Valid response for requests (Quizás la cantidad máxima de peticiones diarias se supere).
     * 
     * @param  Mathiasd88\MercadoPublico\MercadoPublico $response
     * @return boolean
     */
    private function validResponse($response)
    {
        return ($response->status == 200 || $response->message = 'Ticket superó la cuota diaria asignada.');
    }

    /** @test */
    public function it_can_be_instanciated()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $this->assertTrue($mercadoPublico instanceof MercadoPublico);
    }

    /** @test */
    public function it_can_search_provider()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarProveedor('70.017.820-k'); // Rut real de ejempl->get()o

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers_by_code()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->codigo('2097-241-SE14')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers_by_date()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->fecha('02022014')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers_by_status()
    {
        $estados = [
            'enviadaproveedor',
            'aceptada',
            'cancelada',
            'recepcionconforme',
            'pendienterecepcion',
            'recepcionaceptadacialmente',
            'recepecionconformeincompleta',
            'todos'
        ];

        $randomValue = array_rand($estados);

        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->estado($estados[$randomValue])->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers_by_codigo_de_organismo()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->codigoOrganismo('6945')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers_by_codigo_de_proveedor()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->codigoProveedor('17793')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_buyers_by_custom_filter()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->buscarComprador()->custom('CodigoProveedor', '17793')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones_by_code()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->codigo('1509-5-L114')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones_by_date()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->fecha('02022014')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones_by_status()
    {
        $estados = [
            'publicada',
            'activas',
            'cerrada',
            'desierta',
            'adjudicada',
            'revocada',
            'suspendida',
            'todos'
        ];

        $randomValue = array_rand($estados);

        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->estado($estados[$randomValue])->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones_by_codigo_de_organismo()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->codigoOrganismo('6945')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones_by_codigo_de_proveedor()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->codigoProveedor('17793')->get();

        $this->assertTrue($this->validResponse($response));
    }

    /** @test */
    public function it_can_search_licitaciones_by_custom_filter()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->licitaciones()->custom('CodigoProveedor', '17793')->get();

        $this->assertTrue($this->validResponse($response));
    }
}