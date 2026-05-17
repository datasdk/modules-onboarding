<?php

namespace Modules\Onboarding\Http\Controllers;

use App\Http\Controllers\OrionBaseController;
use Orion\Http\Requests\Request;
use Modules\Onboarding\Http\Requests\OnboardingRequest;
use Modules\Onboarding\Models\Onboarding;
use Illuminate\Support\Facades\Log;

class OnboardingController extends OrionBaseController
{
    protected $model = Onboarding::class;
    protected $request = OnboardingRequest::class;

    protected $includes = [
        "user",
        "company",
        "media",
    ];

    /**
     * Display a listing of onboarding requests.
     */
    public function index(Request $req)
    {
        return view('onboarding::index');
    }

    /**
     * Show a specific onboarding request.
     */
    public function show(Request $req, ...$args)
    {
        $onboarding = Onboarding::with(["user", "company", "media"])->findOrFail($args[0]);
        return view('onboarding::show', compact('onboarding'));
    }

    /**
     * Accept an onboarding request.
     */
    public function accept(Request $req, $id)
    {
        $onboarding = Onboarding::findOrFail($id);
        $onboarding->accept();
        
        return redirect()->route('onboarding.index')
                         ->with('success', 'Onboarding request accepted successfully.');
    }

    /**
     * Reject an onboarding request.
     */
    public function reject(Request $req, $id)
    {
        $onboarding = Onboarding::findOrFail($id);
        $onboarding->reject();
        
        return redirect()->route('onboarding.index')
                         ->with('success', 'Onboarding request rejected successfully.');
    }

    /**
     * Store a new onboarding request.
     */
    public function store(Request $req)
    {
        $onboarding = Onboarding::create([
            'description' => $req->description ?? '',
            'user_id' => $req->user_id ?? auth()->id(),
            'company_id' => $req->company_id,
            'status' => 'pending',
        ]);

        // Håndter fil upload
        if ($req->filled('files')) {
            foreach ($req->files as $file) {
                if ($file) {
                    try {
                        $onboarding->addMedia($file)->toMediaCollection('onboarding-files');
                    } catch (\Exception $e) {
                        Log::error("Kunne ikke uploade fil: {$e->getMessage()}");
                    }
                }
            }
        }

        return redirect()->route('onboarding.index')
                         ->with('success', 'Onboarding request created successfully.');
    }

    /**
     * Update an onboarding request.
     */
    public function update(Request $req, ...$args)
    {
        $onboarding = Onboarding::findOrFail($args[0]);

        $onboarding->update([
            'description' => $req->description ?? $onboarding->description,
            'company_id' => $req->company_id ?? $onboarding->company_id,
            'status' => $req->status ?? $onboarding->status,
        ]);

        return redirect()->route('onboarding.index')
                         ->with('success', 'Onboarding request updated successfully.');
    }

    /**
     * Delete an onboarding request.
     */
    public function destroy(Request $req, ...$args)
    {
        $onboarding = Onboarding::findOrFail($args[0]);
        $onboarding->delete();

        return redirect()->route('onboarding.index')
                         ->with('success', 'Onboarding request deleted successfully.');
    }
}