<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //'order_num' => $faker->numberBetween($min = 0, $max = 900),
        'order_at'  => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Asia/Tokyo')
        //'order_at'  => $faker->dateTimeThisMonth($max = '2021-06-30 23:59:59', $timezone = 'Asia/Tokyo')
    ];
});
