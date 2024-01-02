<?php

namespace Tests\Unit;

use Modules\Assunto\Entities\Assunto;
use PHPUnit\Framework\TestCase;

class AssuntoUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $assunto = new Assunto();

        $expected = [
            'Descricao'
        ];

        $arrayCompared = array_diff($expected, $assunto->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
