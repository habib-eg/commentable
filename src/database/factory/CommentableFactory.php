<?php

/** @var Factory $factory */

use App\Commentable;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Commentable::class, function (Faker $faker) {
    return [
        'active'=>$faker->boolean,
        'comment'=>$faker->sentences(rand(3,15),true),
    ];
});
