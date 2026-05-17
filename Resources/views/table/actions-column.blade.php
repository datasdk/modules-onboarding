<div class="d-flex gap-2">
   
    <!-- Accept/Reject knapper (kun hvis pending) -->
    @if($onboarding->status === 'pending')


        <div class="d-flex gap-1">
            <!-- Accept knap -->
            <a href="{{ route('onboarding.accept', $onboarding->id) }}" 
            class="btn btn-sm btn-success mr-2" 
            title="Accepter"
            onclick="return confirm('Er du sikker på at du vil acceptere denne onboarding anmodning?')">
                <i class="fas fa-check"></i> Accepter
            </a>
            
            <!-- Reject knap -->
            <a href="{{ route('onboarding.reject', $onboarding->id) }}" 
            class="btn btn-sm btn-danger" 
            title="Afvis"
            onclick="return confirm('Er du sikker på at du vil afvise denne onboarding anmodning?')">
                <i class="fas fa-times"></i> Afvis
            </a>
            
        </div>

    @endif
</div>