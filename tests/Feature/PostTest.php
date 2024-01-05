<?php

namespace Tests\Feature;

use Modules\Post\Entities\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    protected $service = Post::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listPost'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreatePost()
    {
        $post = factory($this->service)->make();

        $response = $this->postJson(route('createPost'),$post->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

        $this->assertTrue(true);
    }
}
