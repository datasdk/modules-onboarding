<?php

namespace Modules\Onboarding\Database\Seeders;

use Modules\Email\Database\Seeders\Contracts\AbstractEmailTemplateSeeder;

class OnboardingEmailSeeder extends AbstractEmailTemplateSeeder
{
    protected string $moduleName = 'onboarding';

    protected array $templates = [
        'onboarding-created' => \Modules\Onboarding\Contracts\Emails\OnboardingCreated::class,
        'onboarding-accepted' => \Modules\Onboarding\Contracts\Emails\OnboardingAccepted::class,
        'onboarding-rejected' => \Modules\Onboarding\Contracts\Emails\OnboardingRejected::class,
    ];
}
