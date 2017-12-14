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

$factory->define(App\Models\Game::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->unique()->safeEmail,
        'status' => 1
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $games = \App\Models\Game::all()->pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'game_id' => $faker->randomElement($games),
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
        'role' => random_int(0,2),
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
    $users = \App\Models\User::where('role', 2)->get()->pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'first_name'=> $faker->firstName,
        'last_name' => $faker->lastName,
        'date_of_birth' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});