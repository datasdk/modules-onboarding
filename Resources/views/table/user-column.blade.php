{{-- resources/views/vendor/onboarding/table/user-column-simple.blade.php --}}
@if($onboarding->user)
    <a href="#" 
       class="text-decoration-none" 
       data-bs-toggle="modal" 
       data-bs-target="#userModal{{ $onboarding->user->id }}">
        {{ $onboarding->user->first_name }} {{ $onboarding->user->last_name }}
        <br>
        <small class="text-muted">{{ $onboarding->user->email }}</small>
    </a>
    
    <div class="modal fade" id="userModal{{ $onboarding->user->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $onboarding->user->first_name }} {{ $onboarding->user->last_name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Personlige oplysninger -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3 border-bottom pb-2">Personlige Oplysninger</h6>
                            <div class="mb-3">
                                <strong>Fornavn:</strong><br>
                                {{ $onboarding->user->first_name }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Efternavn:</strong><br>
                                {{ $onboarding->user->last_name }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>E-mail:</strong><br>
                                <a href="mailto:{{ $onboarding->user->email }}">{{ $onboarding->user->email }}</a>
                            </div>
                            
                            @if($onboarding->user->contact && $onboarding->user->contact->phone)
                            <div class="mb-3">
                                <strong>Telefon:</strong><br>
                                <a href="tel:{{ $onboarding->user->contact->phone }}">{{ $onboarding->user->contact->phone }}</a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Adresseoplysninger -->
                            @if($onboarding->user->address)
                            <h6 class="mb-3 border-bottom pb-2">Adresse</h6>
                            <div class="mb-3">
                                <strong>Adresse:</strong><br>
                                {{ $onboarding->user->address->street ?? '-' }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Postnummer:</strong><br>
                                {{ $onboarding->user->address->post_code ?? '-' }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>By:</strong><br>
                                {{ $onboarding->user->address->city ?? '-' }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Land:</strong><br>
                                {{ $onboarding->user->address->country->name ?? '' }}
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Yderligere kontaktoplysninger -->
                    @if($onboarding->user->contact && ($onboarding->user->contact->phone || $onboarding->user->contact->email))
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="mb-3">Yderligere Kontaktoplysninger</h6>
                        <div class="row">
                            @if($onboarding->user->contact->phone)
                            <div class="col-md-6 mb-3">
                                <strong>Kontakttelefon:</strong><br>
                                {{ $onboarding->user->contact->phone }}
                            </div>
                            @endif
                            
                            @if($onboarding->user->contact->email)
                            <div class="col-md-6 mb-3">
                                <strong>Kontakt e-mail:</strong><br>
                                <a href="mailto:{{ $onboarding->user->contact->email }}">{{ $onboarding->user->contact->email }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Firma og onboarding status -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Firma:</strong><br>
                                    {{ $onboarding->company->name ?? 'Intet firma' }}
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Onboarding Status:</strong><br>
                                    <span class="badge bg-{{ $onboarding->status === 'accepted' ? 'success' : ($onboarding->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $onboarding->status === 'accepted' ? 'Godkendt' : ($onboarding->status === 'rejected' ? 'Afvist' : 'Afventer') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        @if($onboarding->description)
                        <div class="mb-3">
                            <strong>Beskrivelse:</strong><br>
                            {{ $onboarding->description }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Luk</button>
                </div>
            </div>
        </div>
    </div>
@else
    <span class="text-muted">Ikke tilgængelig</span>
@endif