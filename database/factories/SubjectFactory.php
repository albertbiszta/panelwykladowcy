<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => 'test'.rand(1,1000),
        'exam' => 0,
        'ects' => 5,
        'user_id' => '',
    ];
});
