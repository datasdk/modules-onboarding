<?php

namespace Modules\Onboarding\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Onboarding\Http\Requests\OnboardingSettingsRequest;
use App\Http\Controllers\Controller;
use Settings;
use Modules\Onboarding\Models\Badge;

class OnboardingSettingsController extends Controller
{

    public function index()
    {

        $badges = Badge::all();
        
        $onboardingSettings = [
            'default_verify_badge_id' => config('onboarding.default_verify_badge_id'),
        ];


        return view('onboarding::settings.index', compact('onboardingSettings', 'badges'));

    }


    public function store(OnboardingSettingsRequest $request)
    {

        $settings = [
            'default_verify_badge_id' => $request->input('default_verify_badge_id'),
        ];

        Settings::set('onboarding', $settings);

        return redirect()->route('onboarding.settings.index')->with('success', 'Onboarding settings updated successfully.');

    }


}