<?php

namespace Modules\Onboarding\Listeners;

use Modules\Onboarding\Events\OnboardingCreated;
use Modules\Email\Services\EmailService;
use Illuminate\Support\Facades\Log;

class SendOnboardingCreatedEmail
{
    public function handle(OnboardingCreated $event)
    {
        $onboarding = $event->onboarding;

        $to = config("onboarding.settings.onboarding_admin_email");

        // Brug route name i stedet for hårdkodet URL
        $acceptUrl = route('onboarding.accept', ['id' => $onboarding->id]);
        $rejectUrl = route('onboarding.reject', ['id' => $onboarding->id]);

        try {
            app(EmailService::class)->send([
                'to' => $to,
                'template' => 'onboarding-created',
                'params' => array_merge(
                    $onboarding->load("user","company")->toArray(),
                    [
                        'accept_url' => $acceptUrl,
                        'reject_url' => $rejectUrl,
                    ]
                ),
                'attachments' => $onboarding->getMedia("uploads")
            ]);

        } catch (\Exception $e) {
            Log::warning('Failed to send onboarding created email', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
