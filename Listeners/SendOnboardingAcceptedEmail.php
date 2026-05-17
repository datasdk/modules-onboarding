<?php

namespace Modules\Onboarding\Listeners;

use Modules\Onboarding\Events\OnboardingAccepted;
use Modules\Email\Services\EmailService;
use Illuminate\Support\Facades\Log;

class SendOnboardingAcceptedEmail
{
    public function handle(OnboardingAccepted $event)
    {
        $onboarding = $event->onboarding;

        try {
            app(EmailService::class)->send([
                'to' => $onboarding->user->email ?? 'user@example.com',
                'template' => 'onboarding-accepted',
                'params' => $onboarding->load("user","company")->toArray(),
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to send onboarding accepted email', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
