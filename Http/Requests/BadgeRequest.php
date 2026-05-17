<?php

namespace Modules\Onboarding\Http\Requests;

use Orion\Http\Requests\Request;

class BadgeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the validation rules that apply to the update request.
     */
    public function updateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Navn er påkrævet',
            'slug.required' => 'Slug er påkrævet',
            'slug.unique' => 'Denne slug er allerede i brug',
        ];
    }
}