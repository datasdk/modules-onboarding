<div class="mt-4">
    <h6>Forhåndsvisning:</h6>
    <div class="p-3 border rounded bg-light text-center">
        @php
            $currentIcon = $selectedIcon ?? 'fas fa-certificate';
            $currentName = $name ?? 'Badge';
            $currentDescription = $description ?? 'Beskrivelse';
        @endphp
        <div id="badgePreview">
            <span class="badge badge-pill" style="background-color: #6c757d; color: white; padding: 10px 15px; font-size: 16px;">
                <i class="{{ $currentIcon }}"></i> {{ $currentName }}
            </span>
            <p class="mt-2 mb-0"><small id="descriptionPreview">{{ $currentDescription }}</small></p>
        </div>
    </div>
</div>