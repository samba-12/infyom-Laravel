<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Entreprise;
use Faker\Generator as Faker;

$factory->define(Entreprise::class, function (Faker $faker) {

    return [
        'NomEntreprise' => $faker->word,
        'adresse' => $faker->word,
        'email' => $faker->word,
        'telephone' => $faker->randomDigitNotNull,
        'ninea' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
