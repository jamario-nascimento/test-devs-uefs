<?php

namespace Tests\Feature;

use Modules\Assunto\Entities\Assunto;
use Tests\TestCase;

class AssuntoTest extends TestCase
{
    protected $service = Assunto::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listAssunto'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateAssunto()
    {

        $assunto = factory($this->service)->make();

        $response = $this->postJson(route('createAssunto'),$assunto->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

    }
}
