<?php

use App\Domain\User\Actions\UpdateCountryAttributesAction;
use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 100) as $i) {
            $user = factory(User::class)->create([
               'email' => "user{$i}@attended.io",
            ]);

            (new UpdateCountryAttributesAction())->execute($user);
        }
    }
}
