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

    /** @test */
    public function it_can_be_instanciated()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $this->assertTrue($mercadoPublico instanceof MercadoPublico);
    }

    /** @test */
    public function it_shows_error_when_i_use_a_invalid_ticket()
    {
        // $wrongTicket = 'WRONG-TICKET';

        // $mercadoPublico = new MercadoPublico($wrongTicket);

        // $this->assertFalse($mercadoPublico->isValid());
    }

    /** @test */
    public function it_validates_when_i_use_a_valid_ticket()
    {
        // $mercadoPublico = $this->createMercadoPublicoInstance();

        // $this->assertTrue($mercadoPublico->isValid());
    }

    /** @test */
    public function it_can_search_provider_by_name()
    {
        $mercadoPublico = $this->createMercadoPublicoInstance();

        $response = $mercadoPublico->findProvider('70.017.820-k');

        $this->assertEquals($response->status, 200);
    }
}
