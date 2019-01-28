<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 100) as $i) {
            factory(\App\Models\User::class)->create([
               'email' => "user{$i}@attended.io",
            ]);
        }
    }
}
