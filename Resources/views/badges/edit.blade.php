@extends('layouts.app')

@section('actions')
    <a href="{{ route('onboarding.badges.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Tilbage
    </a>
@endsection

@section('content')

                <div class="card-body">
                    <form method="POST" action="{{ route('onboarding.badges.update', $badge) }}" id="badgeForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Navn *</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $badge->name) }}" 
                                   required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Beskrivelse</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="2">{{ old('description', $badge->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon">Vælg ikon</label>
                            @include('onboarding::badges.includes.icon-select', ['selectedIcon' => old('icon', $badge->icon)])
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Gem ændringer
                            </button>
                            <a href="{{ route('onboarding.badges.index') }}" class="btn btn-secondary">
                                Annuller
                            </a>
                        </div>
                    </form>

                    @include('onboarding::badges.includes.badge-preview', [
                        'selectedIcon' => old('icon', $badge->icon),
                        'name' => old('name', $badge->name),
                        'description' => old('description', $badge->description)
                    ])
                </div>
            </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview opdatering
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const iconSelect = document.getElementById('icon');
    const badgePreview = document.getElementById('badgePreview');
    
    function updatePreview() {
        const icon = iconSelect.value ? iconSelect.value : 'fas fa-certificate';
        const name = nameInput.value ? nameInput.value : 'Badge';
        const description = descriptionInput.value ? descriptionInput.value : 'Beskrivelse';
        
        badgePreview.innerHTML = `
            <span class="badge badge-pill" style="background-color: #6c757d; color: white; padding: 10px 15px; font-size: 16px;">
                <i class="${icon}"></i> ${name}
            </span>
            <p class="mt-2 mb-0"><small>${description}</small></p>
        `;
    }
    
    // Lyt til input ændringer
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    iconSelect.addEventListener('change', updatePreview);
    
    // Initial preview
    updatePreview();
});
</script>
@endsection