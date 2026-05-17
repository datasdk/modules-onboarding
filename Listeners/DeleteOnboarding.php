<?php

namespace Modules\Onboarding\Listeners;

use Modules\Onboarding\Events\OnboardingAccepted;
use Modules\Onboarding\Events\OnboardingRejected;

class DeleteOnboarding
{
    /**
     * Håndter eventet (uanset om det er accept eller reject).
     */
    public function handle($event): void
    {

        $onboarding = $event->onboarding ?? null;

        if ($onboarding) {
            $onboarding->delete();
        }

    }
}
