<?php

namespace Modules\Onboarding\Models;

use Modules\Companies\Models\Companies as BaseCompanies;
use Modules\Onboarding\Traits\HasBadge;


class Companies extends BaseCompanies
{

    use HasBadge;
    
}
