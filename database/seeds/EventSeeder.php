<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        factory(Event::class, 40)->create();
    }
}
