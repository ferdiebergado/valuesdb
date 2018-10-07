<?php

use Faker\Generator as Faker;

$factory->define(App\ActivityParticipant::class, function (Faker $faker) {
    return [
        'participant_id' => $faker->numberBetween(1, 100),
        'activity_id' => $faker->numberBetween(1, 10),
        'role_id' => $faker->numberBetween(1, 25)
    ];
});
