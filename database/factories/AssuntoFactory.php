<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Assunto\Entities\Assunto;
use Faker\Generator as Faker;

$factory->define(Assunto::class, function (Faker $faker) {
    $max = Assunto::max('CodAs');
    return [
        'CodAs' => $max + 1,
        'Descricao' => $faker->word(),
    ];
});
