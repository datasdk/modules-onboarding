<?php

namespace Modules\Onboarding\Models;

use App\Models\User as BaseUser;
use Modules\Onboarding\Traits\HasBadge;


class User extends BaseUser
{
   
    use HasBadge;

}
