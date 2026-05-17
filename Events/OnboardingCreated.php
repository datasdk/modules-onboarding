<?php

namespace Modules\Onboarding\Events;

use Modules\Onboarding\Models\Onboarding;
use Illuminate\Queue\SerializesModels;

class OnboardingCreated
{
    use SerializesModels;

    public $onboarding;

    public function __construct(Onboarding $onboarding)
    {
        $this->onboarding = $onboarding;
    }
}
