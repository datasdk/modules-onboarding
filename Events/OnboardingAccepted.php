<?php

namespace Modules\Onboarding\Events;

use Modules\Onboarding\Models\Onboarding;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OnboardingAccepted
{
    use Dispatchable, SerializesModels;

    public Onboarding $onboarding;

    public function __construct(Onboarding $onboarding)
    {
        $this->onboarding = $onboarding;
    }
}
