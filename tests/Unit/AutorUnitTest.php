<?php

namespace Tests\Unit;

use Modules\Autor\Entities\Autor;
use PHPUnit\Framework\TestCase;

class AutorUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $autor = new Autor();

        $expected = [
            'Nome'
        ];

        $arrayCompared = array_diff($expected, $autor->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
