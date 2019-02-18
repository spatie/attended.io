<?php

use App\Domain\Review\Actions\RecalculateReviewStatisticsAction;
use App\Domain\Event\Models\Event;
use App\Domain\Review\Interfaces\Reviewable;
use App\Domain\Review\Models\Review;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
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
        $reviewableClass::get()->each(function (Reviewable $reviewable) use ($reviewableClass) {
            factory(Review::class, rand(0, 10))->create([
                'reviewable_type' => $reviewableClass,
                'reviewable_id' => $reviewable->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);

            (new RecalculateReviewStatisticsAction())->execute($reviewable);
        });
    }
}
