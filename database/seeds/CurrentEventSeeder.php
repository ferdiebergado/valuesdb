<?php

use Illuminate\Database\Seeder;

class CurrentEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('current_event')->insert(['activity_id' => 1]);
    }
}
