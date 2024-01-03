<?php

namespace Tests\Unit;

use Modules\Post\Entities\Post;
use PHPUnit\Framework\TestCase;

class PostUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $post = new Post();

        $expected = [
            'titulo',
            'resumo',
            'conteudo',
        ];

        $arrayCompared = array_diff($expected, $post->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
