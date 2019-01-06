<?php

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    return [];
    // return [
    //     'name'              => $faker->name,
    //     'firstname'         => $faker->firstname,
    //     'lastname'          => $faker->lastname,
    //     'username'          => $faker->unique()->safeEmail,
    //     'password'          => $password ?: $password = bcrypt('secret'),
    //     'password_salt'     => $faker->password_salt,
    //     'email'             => $faker->unique()->safeEmail,
    //     'remember_token'    => str_random(10),
    // ];
});
