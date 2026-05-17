@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Onboarding Request Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('onboarding.index') }}">Onboarding</a></li>
                    <li class="breadcrumb-item active">View Request</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Request Information</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            <span class="badge bg-{{ $onboarding->status === 'accepted' ? 'success' : ($onboarding->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($onboarding->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Company:</dt>
                        <dd class="col-sm-9">{{ $onboarding->company->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">User:</dt>
                        <dd class="col-sm-9">{{ $onboarding->user->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Description:</dt>
                        <dd class="col-sm-9">{{ $onboarding->description ?? 'No description' }}</dd>

                        <dt class="col-sm-3">Created:</dt>
                        <dd class="col-sm-9">{{ $onboarding->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>

            @if($onboarding->files && count($onboarding->files) > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Attached Files</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($onboarding->files as $file)
                            <a href="{{ $file['url'] }}" target="_blank" class="list-group-item list-group-item-action">
                                <i class="fas fa-file me-2"></i> {{ $file['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($onboarding->status === 'pending')
                            <a href="{{ route('onboarding.accept', $onboarding->id) }}" 
                               class="btn btn-success" 
                               onclick="return confirm('Are you sure you want to accept this onboarding request?')">
                                <i class="fas fa-check me-2"></i> Accept Request
                            </a>
                            
                            <a href="{{ route('onboarding.reject', $onboarding->id) }}" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to reject this onboarding request?')">
                                <i class="fas fa-times me-2"></i> Reject Request
                            </a>
                        @endif
                        
                        <a href="{{ route('onboarding.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection