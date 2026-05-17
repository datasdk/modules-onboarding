@php
    $statusColors = [
        'pending' => 'warning',
        'accepted' => 'success',
        'rejected' => 'danger',
    ];
    
    $statusTexts = [
        'pending' => 'Afventer',
        'accepted' => 'Godkendt',
        'rejected' => 'Afvist',
    ];
@endphp

<span class="badge bg-{{ $statusColors[$onboarding->status] ?? 'secondary' }} px-3 py-2">
    {{ $statusTexts[$onboarding->status] ?? $onboarding->status }}
</span>