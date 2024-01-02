<?php

namespace Tests\Feature;

use Modules\Livro\Entities\Livro;
use Tests\TestCase;

class LivroTest extends TestCase
{
    protected $service = Livro::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listLivro'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateLivro()
    {
        $livro = factory($this->service)->make();

        $response = $this->postJson(route('createLivro'),$livro->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

        $this->assertTrue(true);
    }
}
