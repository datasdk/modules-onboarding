<?php

namespace Modules\Onboarding\Contracts\Emails;

use Modules\Onboarding\Models\Onboarding;
use Modules\Email\Contracts\Abstract\EmailContract;;
use Modules\Email\Models\Email;


class OnboardingCreated extends EmailContract
{

    public function handle(Email $email): bool
    {

        return true;
    }

}
