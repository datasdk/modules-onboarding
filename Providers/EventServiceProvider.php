<?php

namespace Modules\Onboarding\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        \Modules\Onboarding\Events\OnboardingCreated::class => [
            \Modules\Onboarding\Listeners\SendOnboardingCreatedEmail::class,
        ],


        \Modules\Onboarding\Events\OnboardingAccepted::class => [
            \Modules\Onboarding\Listeners\SendOnboardingAcceptedEmail::class,
            \Modules\Onboarding\Listeners\SetBadges::class,
        ],

        \Modules\Onboarding\Events\OnboardingRejected::class => [
            \Modules\Onboarding\Listeners\SendOnboardingRejectedEmail::class,
        ],

      
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
