<?php

namespace Modules\Onboarding\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnboardingSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'default_verify_badge_id' => 'nullable|exists:badges,id',
        ];
    }

    public function messages()
    {
        return [
            'default_verify_badge_id.exists' => 'Selected badge does not exist.',
        ];
    }
}