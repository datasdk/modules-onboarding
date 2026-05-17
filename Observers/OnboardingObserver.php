<?php

namespace Modules\Onboarding\Observers;

use Modules\Onboarding\Models\Onboarding;

class OnboardingObserver
{
    /**
     * Handle the Onboarding "deleting" event.
     */
    public function deleting(Onboarding $onboarding)
    {
        // Slet alle tilknyttede medier
        if ($onboarding->media()->exists()) {
            $onboarding->media()->delete();
        }
    }
}
