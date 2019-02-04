<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this
            ->call(UserSeeder::class)
            ->call(EventSeeder::class)
            ->call(TrackSeeder::class)
            ->call(SlotSeeder::class)
            ->call(ReviewSeeder::class)
            ->call(AttendanceSeeder::class);
    }
}
