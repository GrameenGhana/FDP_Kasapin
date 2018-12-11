<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Auth\Permission::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
    ];
});
