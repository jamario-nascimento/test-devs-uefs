<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Autor\Entities\Autor;
use Faker\Generator as Faker;

$factory->define(Autor::class, function (Faker $faker) {
    $max = Autor::max('CodAu');
    return [
        'CodAu' => $max + 1,
        'Nome' => $faker->name($faker->numberBetween(10, 40)),
    ];
});


