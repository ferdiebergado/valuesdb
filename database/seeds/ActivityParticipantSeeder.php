<?php

use Illuminate\Database\Seeder;
use App\ActivityParticipant;

class ActivityParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ActivityParticipant::class, 100)->create();
    }
}
