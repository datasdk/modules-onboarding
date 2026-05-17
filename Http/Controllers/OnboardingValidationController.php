<?php

namespace Modules\Onboarding\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onboarding\Models\Onboarding;
use App\Http\Controllers\Controller;

class OnboardingValidationController extends Controller
{
    /**
     * Accept an onboarding request
     */
    public function accept($id)
    {

        $onboarding = Onboarding::findOrFail($id);
        
        $onboarding->accept();
        
        return redirect()->route('onboarding.index')
            ->with('success', 'Onboarding anmodning er accepteret.');
    }

    /**
     * Reject an onboarding request
     */
    public function reject($id)
    {

        $onboarding = Onboarding::findOrFail($id);
        
        $onboarding->reject();
        
        return redirect()->route('onboarding.index')
            ->with('success', 'Onboarding anmodning er afvist.');
    }
}