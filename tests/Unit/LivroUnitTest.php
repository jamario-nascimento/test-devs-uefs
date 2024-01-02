<?php

namespace Tests\Unit;

use Modules\Livro\Entities\Livro;
use PHPUnit\Framework\TestCase;

class LivroUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $livro = new Livro();

        $expected = [
            'Titulo',
            'Editora',
            'Edicao',
            'AnoPublicacao',
            'Valor',
        ];

        $arrayCompared = array_diff($expected, $livro->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
