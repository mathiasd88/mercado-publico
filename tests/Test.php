<?php

use Mathiasd88\MercadoPublico\MercadoPublico;

class Test extends PHPUnit_Framework_TestCase
{
    protected $defaultTicket = 'F8537A18-6766-4DEF-9E59-426B4FEE2844';

    protected $defaultDate = '02022014';

    /** @test */
    public function it_can_be_instanciated()
    {
        $mercadoPublico = new MercadoPublico($this->defaultTicket);

        $this->assertTrue($mercadoPublico instanceof MercadoPublico);
    }

    /** @test */
    public function it_returns_a_json_response()
    {
        // $mercadoPublico = new MercadoPublico();
    }

    /** @test */
    public function it_shows_error_when_i_use_a_invalid_ticket()
    {
        $wrongTicket = 'WRONG-TICKET';

        $mercadoPublico = new MercadoPublico($wrongTicket);

        $this->assertFalse($mercadoPublico->isValid());
    }

    /** @test */
    public function it_validates_when_i_use_a_valid_ticket()
    {
        $mercadoPublico = new MercadoPublico($this->defaultTicket);

        $this->assertTrue($mercadoPublico->isValid());
    }

    /** @test */
    public function it_can_search_provider_by_name()
    {
        //
    }
}