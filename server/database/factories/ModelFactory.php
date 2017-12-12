<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'game_id' => str_random(5),
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Admin::class, function (Faker\Generator $faker){
    static $password;

    return [
        'username' => $faker->userName,
        'password' => $password ?: $password = bcrypt('123456'),
        'adminname' => $faker->name,
    ];
});

$factory->define(App\Models\UserDetails::class, function (Faker\Generator $faker){
    return [
        'first_name'=> $faker->firstName,
        'last_name' => $faker->lastName,
        'date_of_birth' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});