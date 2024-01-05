<?php

namespace Tests\Feature;

use Modules\Tag\Entities\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    protected $service = Tag::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listTag'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateTag()
    {

        $tag = factory($this->service)->make();

        $response = $this->postJson(route('createTag'),$tag->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

    }
}
