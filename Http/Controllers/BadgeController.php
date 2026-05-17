<?php

namespace Modules\Onboarding\Http\Controllers;

use Modules\Onboarding\Http\Requests\BadgeRequest;
use Modules\Onboarding\Models\Badge;
use Modules\Companies\Models\Companies;
use App\Http\Controllers\OrionBaseController;
use Orion\Http\Requests\Request;

class BadgeController extends OrionBaseController
{
    protected $model = Badge::class;
    protected $request = BadgeRequest::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $req, ...$args)
    {
        return view('onboarding::badges.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req, ...$args)
    {
        return view('onboarding::badges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req, ...$args)
    {
        try {
            // Validering sker automatisk via BadgeRequest
            $validated = $req->validated();
            
            Badge::create($validated);

            return redirect()->route('onboarding.badges.index')
                ->with('success', 'Badge oprettet!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Fejl under oprettelse: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req, ...$args)
    {
        $id = $args[0];
        $badge = Badge::findOrFail($id);
        
        // Hent alle firmaer med dette badge
        $companiesWithBadge = $badge->getModelsWithThisBadge(Companies::class);
        
        return view('onboarding::badges.show', compact('badge', 'companiesWithBadge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, ...$args)
    {
        $id = $args[0];
        $badge = Badge::findOrFail($id);
        
        return view('onboarding::badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, ...$args)
    {
        $id = $args[0];
        
        try {
            // Validering sker automatisk via BadgeRequest
            $validated = $req->validated();
            
            $badge = Badge::findOrFail($id);
            $badge->update($validated);

            return redirect()->route('onboarding.badges.index')
                ->with('success', 'Badge opdateret!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Fejl under opdatering: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, ...$args)
    {
        $id = $args[0];
        
        try {
            $badge = Badge::findOrFail($id);
            $badge->delete();

            return redirect()->route('onboarding.badges.index')
                ->with('success', 'Badge slettet!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Fejl under sletning: ' . $e->getMessage()]);
        }
    }

    

    /**
     * Fjern badge fra firma (ekstra metode)
     */
    public function removeFromCompany(Request $req, ...$args)
    {
        try {
            $req->validate([
                'company_id' => 'required|exists:companies,id'
            ]);

            $badgeId = $args[0];
            $badge = Badge::findOrFail($badgeId);
            $company = Companies::findOrFail($req->company_id);
            
            $badge->removeFromModel($company);

            return redirect()->back()
                ->with('success', 'Badge fjernet fra firma!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Fejl: ' . $e->getMessage()]);
        }
    }
}