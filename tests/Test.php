<?php

use Mathiasd88\MercadoPublico\MercadoPublico;

class Test extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_be_instanciated()
    {
        $mercadoPublico = new MercadoPublico();

        $this->assertTrue($mercadoPublico instanceof MercadoPublico);
    }

    /** @test */
    public function it_can_search_provider_by_name()
    {
        //
    }
}