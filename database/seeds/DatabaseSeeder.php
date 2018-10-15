<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(ParticipantSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(JobtitlesTableSeeder::class);
        $this->call(RegionsDivisionsTableSeeder::class);
        //$this->call(ActivitySeeder::class);
        //$this->call(ActivityParticipantSeeder::class);
        $this->call(CurrentEventSeeder::class);
    }
}
