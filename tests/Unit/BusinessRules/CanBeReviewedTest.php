<?php

namespace Tests\Unit\BusinessRules;

use App\Domain\Review\Actions\StoreReviewAction;
use App\Domain\Review\BusinessRules\CanBeReviewed;
use App\Domain\Review\Exceptions\ReviewableEndedTooLongAgo;
use App\Domain\Review\Exceptions\ReviewablehasNotStartedYet;
use App\Domain\Review\Exceptions\ReviewableWasAlreadyReviewed;
use App\Models\Event;
use App\Models\Interfaces\Reviewable;
use App\Domain\User\Models\User;
use Tests\TestCase;

class CanBeReviewedTest extends TestCase
{
    /** @var \App\Models\Interfaces\Reviewable */
    protected $reviewable;

    /** @var \App\Domain\User\Models\User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->setNow(2019, 1, 1, 13, 0, 0);

        $this->reviewable = factory(Event::class)->create([
            'starts_at' => now()->subDays(3),
            'ends_at' => now(),
        ]);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_can_pass_all_rules()
    {
        $this->assertRulePasses($this->user, $this->reviewable);
    }

    /** @test */
    public function an_event_cannot_be_reviewed_up_until_one_month_after_it_ends()
    {
        $this->assertRulePasses($this->user, $this->reviewable);

        $this->progressTime(60 * 24 * 29);
        $this->assertRulePasses($this->user, $this->reviewable);

        $this->progressTime(60 * 24 * 30);
        $this->expectRuleFails($this->user, $this->reviewable, ReviewableEndedTooLongAgo::class);
    }

    /** @test */
    public function an_event_cannot_be_reviewed_before_it_starts()
    {
        $reviewable = factory(Event::class)->create([
            'starts_at' => now()->addMinute(),
        ]);

        $this->expectRuleFails($this->user, $reviewable, ReviewablehasNotStartedYet::class);

        $this->progressTime(1);

        $this->assertRulePasses($this->user, $reviewable);
    }

    /** @test */
    public function a_reviewable_cannot_be_reviewed_twice()
    {
        (new StoreReviewAction())->execute($this->user, $this->reviewable, [
            'rating' => 4,
            'remarks' => 'hey'
        ]);

        $this->expectRuleFails($this->user, $this->reviewable, ReviewableWasAlreadyReviewed::class);
    }

    protected function assertRulePasses(User $user, Reviewable $reviewable)
    {
        $this->assertTrue((new CanBeReviewed($user, $reviewable))->passes());
    }

    protected function expectRuleFails(User $user, Reviewable $reviewable, string $exceptionClass)
    {
        $this->expectException($exceptionClass);

        (new CanBeReviewed($user, $reviewable))->ensure();
    }
}
