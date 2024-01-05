<?php

namespace Tests\Unit;

use Modules\Tag\Entities\Tag;
use PHPUnit\Framework\TestCase;

class TagUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $autor = new Tag();

        $expected = [
            'Slug'
        ];

        $arrayCompared = array_diff($expected, $autor->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
