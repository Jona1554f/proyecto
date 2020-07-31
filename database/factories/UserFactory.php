<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [

        'ethnic_origin_id' => random_int(31, 38),
        'location_id' => 62,
        'identification_type_id' => random_int(44, 45),
        'identification' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
        'first_name' => $faker->firstNameMale,
        'second_name' => $faker->firstNameMale,
        'first_lastname' => $faker->lastName,
        'second_lastname' => $faker->lastName,
        'sex_id' => 40,
        'gender_id' => 42,
        'personal_email' => $faker->unique()->safeEmail,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'blood_type_id' => random_int(46, 53),
        'user_name' => $faker->word,
        'email' => $faker->unique()->safeEmail,
        'state_id' => 1,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

    ];
});
