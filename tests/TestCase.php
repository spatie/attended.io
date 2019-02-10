<?php

namespace Tests;

use App\Models\User;
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
}
