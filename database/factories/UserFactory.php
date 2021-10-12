<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    $date = Carbon::create(rand(1980,2000), rand(1,12), rand(1,28), 0, 0, 0);
    $email = $faker->unique()->safeEmail;
    return [
        'username'=> $this->faker->unique()->userName,
        'email'=> $email,
        'phone'=>  $faker->phoneNumber,
        'mobile'=>  $faker->phoneNumber,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender'=> rand(1, 2),
        'postal_code'=>$faker->creditCardNumber,
        'fax_number'=>$faker->creditCardNumber,
        'birth_place'=> $faker->city,
        'birth_date'=> $date,
        'address'=> $faker->address,
        'is_confirm' => 1,
        'remember_token'=> base64_encode($email)
    ];
});
