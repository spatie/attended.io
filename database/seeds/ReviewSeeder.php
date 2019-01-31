<?php

use App\Actions\RecalculateReviewStatistics;
use App\Models\Review;
use App\Models\Event;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        collect([
            Event::class,
            Slot::class,
        ])->each(function (string $reviewableClass) {
            $this->seedReviews($reviewableClass);
        });
    }

    protected function seedReviews(string $reviewableClass)
    {
        $reviewableClass::get()->each(function (Model $model) use ($reviewableClass) {
            Collection::times(rand(0, 10))->each(function () use ($model, $reviewableClass) {
                factory(Review::class)->create([
                    'reviewable_type' => $reviewableClass,
                    'reviewable_id' => $model->id,
                    'user_id' => User::inRandomOrder()->first(),
                ]);
            });

            (new RecalculateReviewStatistics($model))->execute();

        });
    }
}
