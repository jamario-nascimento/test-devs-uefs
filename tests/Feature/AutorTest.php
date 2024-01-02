<?php

namespace Tests\Feature;

use Modules\Autor\Entities\Autor;
use Tests\TestCase;

class AutorTest extends TestCase
{
    protected $service = Autor::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listAutor'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateAutor()
    {

        $autor = factory($this->service)->make();

        $response = $this->postJson(route('createAutor'),$autor->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

    }
}
