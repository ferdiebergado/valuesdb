<?php

use Faker\Generator as Faker;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
        'activitytitle' => $faker->realText(30),
        'venue' => $faker->city(),
        'startdate' => $faker->date(),
        'enddate' => $faker->date(),
        'managedby' => $faker->company()
    ];
});
