<?php

namespace Modules\Onboarding\Listeners;

use Modules\Onboarding\Events\OnboardingRejected;
use Modules\Email\Services\EmailService;
use Illuminate\Support\Facades\Log;

class SendOnboardingRejectedEmail
{
    public function handle(OnboardingRejected $event)
    {
        $onboarding = $event->onboarding;



        try {

            app(EmailService::class)->send([
                'to' => $onboarding->user->email ?? 'user@example.com',
                'template' => 'onboarding-rejected',
                'params' => $onboarding->load("user","company")->toArray(),
            ]);

        } catch (\Exception $e) {
        
            Log::warning('Failed to send onboarding rejected email', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
