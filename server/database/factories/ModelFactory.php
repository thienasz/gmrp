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
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $games = \App\Models\Game::all()->pluck('id')->toArray();
    $agency = \App\Models\Agency::all()->pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'game_id' => $faker->randomElement($games),
        'agency_id' => $faker->randomElement($agency),
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
$factory->define(App\Models\PaymentType::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->randomElement(['Viettel', 'Mobi', 'Vina']),
    ];
});

$factory->define(App\Models\Payment::class, function (Faker\Generator $faker){
    $users = \App\Models\User::whereIn('role', [0,2])->get();
    $index = $faker->numberBetween(0, 19);
    $user = $users[$index];
    return [
        'game_id' => $user->game_id,
        'user_id' => $user->id,
        'agency_id' => $user->agency_id,
        'pay_price' => $faker->randomFloat(5),
        'pay_card_type' => $faker->randomElement([3,1,2])
    ];
});


$factory->define(App\Models\GameSessionTracker::class, function (Faker\Generator $faker){
    $users = \App\Models\User::whereIn('role', [0,2])->get();
    $index = $faker->numberBetween(0, $users->count());
    $index = $faker->numberBetween(0, 19);
    $user = $users[$index];
    $login = $faker->dateTimeBetween('-5 days', '-2 days');
    return [
        'game_id' => $user->game_id,
        'user_id' => $user->id,
        'agency_id' => $user->agency_id,
        'login_at' => $login,
        'logout_at' => $login->add(date_interval_create_from_date_string('1 days')),
        'is_online' => $faker->randomElement([0, 1]),
    ];
});

$factory->define(App\Models\NewRegisterTracker::class, function (Faker\Generator $faker){
    $users = \App\Models\User::whereIn('role', [0,2])->get();
    $index = $faker->numberBetween(0, 19);
    $user = $users[$index];
    return [
        'game_id' => $user->game_id,
        'user_id' => $user->id,
        'agency_id' => $user->agency_id,
    ];
});

$factory->define(App\Models\Agency::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'percent_share' => $faker->numberBetween(1, 100),
    ];
});