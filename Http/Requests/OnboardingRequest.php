<?php

namespace Modules\Onboarding\Http\Requests;

use Orion\Http\Requests\Request;

class OnboardingRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'company_id' => 'required|integer|exists:companies,id',
            'description' => 'sometimes|string',

            // FILES
            'files' => 'sometimes|array|min:1',
            'files.*' => 'required_with:files|file|mimes:jpg,jpeg,png,pdf|max:10240',

            // FILENAMES (optional)
            'file_names' => 'sometimes|array',
            'file_names.*' => 'string|max:255',
        ];
    }

    public function updateRules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'company_id' => 'sometimes|integer|exists:companies,id',
            'description' => 'sometimes|string',

            // FILES
            'files' => 'sometimes|array|min:1',
            'files.*' => 'required_with:files|file|mimes:jpg,jpeg,png,pdf|max:10240',

            // FILENAMES (optional)
            'file_names' => 'sometimes|array',
            'file_names.*' => 'string|max:255',

            'status' => 'sometimes|in:pending,accepted,rejected'
        ];
    }
}
