<?php

namespace Tests;

use App\Domain\User\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Notification;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        RefreshDatabase;

    protected function getHtmlForNotificationMail(Notification $notification, User $notifiable): string
    {
        $mailMessage = ($notification)->toMail($notifiable);

        $markdown = new Markdown(view(), config("mail.markdown"));

        return $markdown->render($mailMessage->markdown, $mailMessage->viewData);
    }

    public function setNow($year, $month, $day, $hour = null, $minute = null, $second = null)
    {
        $newNow = Carbon::create($year, $month, $day, $hour, $minute, $second);

        if (is_null($hour) && is_null($minute) && is_null($second)) {
            $newNow = $newNow->copy()->startOfDay();
        }


        Carbon::setTestNow($newNow);

        return $this;
    }

    public function progressTime(int $minutes)
    {
        $newNow = now()->copy()->addMinutes($minutes);

        Carbon::setTestNow($newNow);

        return $this;
    }
}
