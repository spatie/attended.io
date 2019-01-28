<?php

use App\Models\Comment;
use App\Models\Event;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        collect([
            Event::class,
            Slot::class,
        ])->each(function(string $commentableClass) {
            $this->seedComments($commentableClass);
        });
    }

    protected function seedComments(string $commentableClass)
    {
        $commentableClass::get()->each(function(Model $model) use ($commentableClass) {
            Collection::make(rand(0, 10))->each(function() use ($model, $commentableClass) {
                factory(Comment::class)->create([
                    'commentable_type' => $commentableClass,
                    'commentable_id' => $model->id,
                    'user_id' => User::inRandomOrder()->first(),
                ]);
            });
        });

    }
}
