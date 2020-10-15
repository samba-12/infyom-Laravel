<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Operations;
use Faker\Generator as Faker;

$factory->define(Operations::class, function (Faker $faker) {

    return [
        'NomEntreprise' => $faker->word,
        'TypeOperation' => $faker->word,
        'Montant' => $faker->word,
        'Solde' => $faker->word,
        'DateOperation' => $faker->word,
        'numeroCompte_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
