<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Post\Entities\Post;
use Faker\Generator as Faker;
use Modules\Tag\Entities\Tag;
use Modules\Usuario\Entities\Usuario;

$factory->define(Post::class, function (Faker $faker) {
    $max = Post::max('id');
    $maxTags = Tag::max('idTag');
    $usuario = Usuario::max('idUsuario');
    return [
        'id' => $max + 1,
        'titulo' => $faker->name($faker->numberBetween(10, 100)),
        'resumo' => $faker->text(200),
        'conteudo' => $faker->sentence(1000),
        'tag' => [$maxTags],
        'usuario' => [$usuario],
    ];
});


