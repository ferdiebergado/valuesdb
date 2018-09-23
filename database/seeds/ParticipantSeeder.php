<?php

use Illuminate\Database\Seeder;
use App\Participant;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Participant::class, 100)->create();
    }
}
