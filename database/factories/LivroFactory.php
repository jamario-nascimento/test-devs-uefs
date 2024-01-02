<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Livro\Entities\Livro;
use Faker\Generator as Faker;
use Modules\Assunto\Entities\Assunto;
use Modules\Autor\Entities\Autor;

$factory->define(Livro::class, function (Faker $faker) {
    $max = Livro::max('Codl');
    $maxAutores = Autor::max('CodAu');
    $maxAssuntos = Assunto::max('CodAs');
    return [
        'Codl' => $max + 1,
        'Titulo' => $faker->name($faker->numberBetween(10, 40)),
        'Editora' => $faker->name($faker->numberBetween(10, 40)),
        'Edicao' => $faker->randomDigitNot(0),
        'AnoPublicacao' => $faker->numberBetween(1900,2023),
        'Valor' => $faker->randomFloat(2, 8, 9999),
        'Autores' => [$maxAutores],
        'Assuntos' => [$maxAssuntos],
    ];
});


