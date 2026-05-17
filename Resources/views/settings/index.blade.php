@extends('layouts.app')

@section('content')

    <h3 class="mb-4">Onboarding Settings</h3>

    <form method="POST" action="{{ route('onboarding.settings.store') }}">
        @csrf

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Default Verify Badge Settings</h5>
            </div>
            <div class="card-body">
                <!-- DEFAULT VERIFY BADGE -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Default Verify Badge</label>
                    <select class="form-control" name="default_verify_badge_id">
                        <option value="">No default badge</option>
                        @foreach($badges as $badge)
                            <option value="{{ $badge->id }}" 
                                    @selected($onboardingSettings['default_verify_badge_id'] == $badge->id)>
                                {{ $badge->name }} ({{ $badge->slug }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Default badge assigned after successful verification</small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                    <a href="{{ route('onboarding.settings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>

@endsection