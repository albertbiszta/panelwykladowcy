<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => 'test'.rand(1,1000),
        'contact' =>'',
        'user_id' => '',
    ];
});
