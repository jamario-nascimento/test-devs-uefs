<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Tag\Entities\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $max = Tag::max('id');
    return [
        'is' => $max + 1,
        'Slug' => $faker->name($faker->numberBetween(10, 40)),
    ];
});


