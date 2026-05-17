{{-- resources/views/vendor/onboarding/table/files-livewire-column.blade.php --}}
@php
    $files = $onboarding->files ?? [];
@endphp

@if($files && count($files) > 0)
    <div class="files-action-container">
        <!-- Vis knap uanset antal filer -->
        <button type="button" 
                class="btn btn-sm btn-outline-info btn-files-modal" 
                data-bs-toggle="modal" 
                data-bs-target="#filesModal{{ $onboarding->id ?? 'default' }}">
            <i class="fas fa-paperclip me-1"></i>
            {{ count($files) }} filer
        </button>
        
        <!-- Modal med Livewire komponent -->
        <div class="modal  fade" id="filesModal{{ $onboarding->id ?? 'default' }}" 
             tabindex="-1" 
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Filer for {{ $onboarding->company->name ?? 'Onboarding' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- Livewire komponent -->
                        @livewire('media::file-preview', ['files' => $files], key('files-' . $onboarding->id))
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Luk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <span class="text-muted">
        <i class="fas fa-file-slash me-1"></i> -
    </span>
@endif

<style>
.btn-files-modal {
    font-size: 0.875rem;
    padding: 0.25rem 0.5rem;
}

.modal-xl {
    max-width: 1200px;
}
</style>