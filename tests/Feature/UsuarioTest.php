<?php

namespace Tests\Feature;

use Modules\Usuario\Entities\Usuario;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    protected $service = Usuario::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listUsuario'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateTag()
    {

        $usuario = factory($this->service)->make();

        $response = $this->postJson(route('createUsuario'),$usuario->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

    }
}
