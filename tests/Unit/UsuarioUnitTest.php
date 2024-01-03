<?php

namespace Tests\Unit;

use Modules\Usuario\Entities\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $usuario = new Usuario();

        $expected = [
            'nome',
            'data_nascimento',
            'email'
        ];

        $arrayCompared = array_diff($expected, $usuario->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
