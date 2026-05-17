<?php

namespace Modules\Onboarding\Http\Controllers\Api;

use Modules\Onboarding\Models\Onboarding;
use Modules\Onboarding\Http\Requests\OnboardingRequest;
use Orion\Http\Requests\Request;
use App\Http\Controllers\OrionBaseController;
use Modules\Onboarding\Events\OnboardingCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OnboardingController extends OrionBaseController
{
    protected $model = Onboarding::class;
    protected $request = OnboardingRequest::class;

    protected $includes = [
        "user",
        "company",
        "media"
    ];

    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validated();

            if (!isset($data['user_id'])) {
                $data['user_id'] = auth()->id();
            }

            $onboarding = Onboarding::create($data);

            if ($request->has('files') && is_array($request->files->get('files'))) {
                $file_names = $request->file_names ?? [];
                $onboarding->uploadFiles(
                    $request->files->get('files'),
                    $collection = 'uploads',
                    $disk = 'uploads',
                    $file_names
                );
            }

            event(new OnboardingCreated($onboarding));

            // EKSPLICIT returnér som JSON med toArray()
            return response()->json([
                'success' => true,
                'data' => $onboarding->load($this->includes)->toArray(),
                'message' => 'Onboarding created successfully'
            ], 201);

        } catch (\Exception $e) {
            Log::error('Onboarding store error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error creating onboarding',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    public function update(Request $request, ...$args): JsonResponse
    {

        try {

            $id = $args[0] ?? null; // FIX: Get ID from args
            

            if (!$id) {

                return response()->json([
                    'success' => false,
                    'message' => 'ID parameter missing'
                ], 400);

            }


            $data = $request->validated();

            $onboarding = Onboarding::findOrFail($id);
            $onboarding->update($data);


            if ($request->has('files') && is_array($request->files->get('files'))) {

                $file_names = $request->file_names ?? [];

                $onboarding->addFiles(
                    $request->files->get('files'),
                    $collection = 'uploads',
                    $disk = 'uploads',
                    $file_names
                );

            }


            // EKSPLICIT returnér som JSON med toArray()
            return response()->json([
                'success' => true,
                'data' => $onboarding->fresh()->load($this->includes)->toArray(),
                'message' => 'Onboarding updated successfully'
            ]);


        } catch (\Exception $e) {

            Log::error('Onboarding update error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating onboarding',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);

        }

    }



    public function accept(Request $req, $id): JsonResponse
    {

        try {

            $onboarding = Onboarding::findOrFail($id);
            

            // Valider at status er pending
            if ($onboarding->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Only pending onboarding requests can be accepted'
                ], 400);
            }
            

            $onboarding->accept();

            // EKSPLICIT returnér som JSON med toArray()
            return response()->json([
                'success' => true,
                'data' => $onboarding->fresh()->load($this->includes)->toArray(),
                'message' => 'Onboarding accepted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Onboarding accept error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error accepting onboarding',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    public function reject(Request $req, $id): JsonResponse
    {
        try {
            $onboarding = Onboarding::findOrFail($id);

            // Valider at status er pending
            if ($onboarding->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Only pending onboarding requests can be rejected'
                ], 400);
            }
            
            $onboarding->reject();

            // EKSPLICIT returnér som JSON med toArray()
            return response()->json([
                'success' => true,
                'data' => $onboarding->fresh()->load($this->includes)->toArray(),
                'message' => 'Onboarding rejected successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Onboarding reject error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error rejecting onboarding',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}