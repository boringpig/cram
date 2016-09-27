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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Student::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'graduated_school' => '斗六國小',
        'parent_name' => $faker->name,
        'status' => 1
    ];
});

$factory->define(App\Models\Phone::class, function (Faker\Generator $faker) {
    return [
        'student_phone' => $faker->phoneNumber,
        'parent_phone' => $faker->phoneNumber,
    ];
});

$factory->define(App\Models\Address::class, function (Faker\Generator $faker) {
    return [
        'home_address' => $faker->address,
    ];
});
