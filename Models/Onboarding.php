<?php

namespace Modules\Onboarding\Models;

use Illuminate\Database\Eloquent\Model;
use DataSDK\Tools\Traits\DateFormat;
use App\Models\User;
use Modules\Onboarding\Models\Companies;
use Modules\Media\Traits\InteractsWithMedia;
use Modules\Media\Contracts\HasMedia;
use Modules\Onboarding\Events\OnboardingAccepted;
use Modules\Onboarding\Events\OnboardingRejected;
use DataSDK\Tools\Traits\Slugs\TranslatableSlug;

class Onboarding extends Model implements HasMedia
{
    use DateFormat;
    use InteractsWithMedia;

    protected $appends = [
        "files"
    ];

    protected $fillable = [
        'description',
        'user_id',
        'company_id',
        'status',
    ];


    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');

    }


    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    public function accept()
    {
        $this->update(['status' => 'accepted']);
        $this->deleteAllMedia(); // hvis du vil rydde filer
        event(new OnboardingAccepted($this));
    }

    public function reject()
    {
        $this->update(['status' => 'rejected']);
        $this->deleteAllMedia(); // hvis du vil rydde filer
        event(new OnboardingRejected($this));
    }
}
