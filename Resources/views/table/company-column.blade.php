{{-- resources/views/vendor/onboarding/table/company-column.blade.php --}}
@if($onboarding->company)
    <a href="#" 
       class="text-decoration-none" 
       data-bs-toggle="modal" 
       data-bs-target="#companyModal{{ $onboarding->company->id }}">
        {{ $onboarding->company->name }}
        @if($onboarding->company->vat)
            <br>
            <small class="text-muted">CVR: {{ $onboarding->company->vat }}</small>
        @endif
    </a>
    
    <div class="modal fade" id="companyModal{{ $onboarding->company->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-building me-2"></i>
                        {{ $onboarding->company->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Firma basisoplysninger -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="mb-3 border-bottom pb-2">Firmaoplysninger</h6>
                            <div class="mb-3">
                                <strong>Firmanavn:</strong><br>
                                {{ $onboarding->company->name }}
                            </div>
                            
                            @if($onboarding->company->vat)
                            <div class="mb-3">
                                <strong>CVR-nummer:</strong><br>
                                {{ $onboarding->company->vat }}
                            </div>
                            @endif
                            
                            <div class="mb-3">
                                <strong>Primært firma:</strong><br>
                                {{ $onboarding->company->is_primary ? 'Ja' : 'Nej' }}
                            </div>
                            
                            @if($onboarding->company->tags && count($onboarding->company->tags) > 0)
                            <div class="mb-3">
                                <strong>Tags:</strong><br>
                                @foreach($onboarding->company->tags as $tag)
                                    <span class="badge bg-secondary me-1">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Adresseoplysninger -->
                            @if($onboarding->company->address)
                            <h6 class="mb-3 border-bottom pb-2">Adresse</h6>
                            <div class="mb-2">
                                <strong>Adresse:</strong><br>
                                {{ $onboarding->company->address->street ?? '-' }}
                            </div>
                            
                            <div class="mb-2">
                                <strong>Postnummer:</strong><br>
                                {{ $onboarding->company->address->post_code ?? '-' }}
                            </div>
                            
                            <div class="mb-2">
                                <strong>By:</strong><br>
                                {{ $onboarding->company->address->city ?? '-' }}
                            </div>
                            
                            <div class="mb-2">
                                <strong>Land:</strong><br>
                                {{ $onboarding->company->address->country->name ?? '-' }}
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Kontaktoplysninger -->
                    @if($onboarding->company->contact)
                    <div class="row mb-4 pt-3 border-top">
                        <div class="col-12">
                            <h6 class="mb-3">Kontaktoplysninger</h6>
                            <div class="row">
                                @if($onboarding->company->contact->phone)
                                <div class="col-md-6 mb-3">
                                    <strong>Telefon:</strong><br>
                                    <a href="tel:{{ $onboarding->company->contact->phone }}">{{ $onboarding->company->contact->phone }}</a>
                                </div>
                                @endif
                                
                                @if($onboarding->company->contact->email)
                                <div class="col-md-6 mb-3">
                                    <strong>E-mail:</strong><br>
                                    <a href="mailto:{{ $onboarding->company->contact->email }}">{{ $onboarding->company->contact->email }}</a>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Flere adresser hvis tilgængelige -->
                            @if($onboarding->company->addresses && $onboarding->company->addresses->count() > 1)
                            <div class="mt-3">
                                <strong>Andre adresser:</strong><br>
                                @foreach($onboarding->company->addresses->skip(1) as $address)
                                    <div class="mt-2 p-2 bg-light rounded">
                                        {{ $address->street ?? '' }}<br>
                                        {{ $address->post_code ?? '' }} {{ $address->city ?? '' }}<br>
                                        {{ $address->country->name ?? '' }}
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Datterselskaber -->
                    @if($onboarding->company->subsidiaries && $onboarding->company->subsidiaries->count() > 0)
                    <div class="row pt-3 border-top">
                        <div class="col-12">
                            <h6 class="mb-3">Datterselskaber</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Firmanavn</th>
                                            <th>CVR</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($onboarding->company->subsidiaries as $subsidiary)
                                        <tr>
                                            <td>{{ $subsidiary->name }}</td>
                                            <td>{{ $subsidiary->vat ?? '-' }}</td>
                                            <td>
                                                @if($subsidiary->is_primary)
                                                    <span class="badge bg-primary">Primær</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Team og medlemmer -->
                    @if($onboarding->company->team)
                    <div class="row pt-3 border-top">
                        <div class="col-12">
                            <h6 class="mb-3">Team & Medlemmer</h6>
                            <div class="mb-2">
                                <strong>Team navn:</strong> {{ $onboarding->company->team->name ?? '' }}
                            </div>
                            
                            @if($onboarding->company->team->members && $onboarding->company->team->members->count() > 0)
                            <div class="mt-2">
                                <strong>Medlemmer ({{ $onboarding->company->team->members->count() }}):</strong>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($onboarding->company->team->members as $member)
                                        <span class="badge bg-info">
                                            {{ $member->first_name }} {{ $member->last_name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Luk</button>
                    @if(auth()->user()->can('edit', $onboarding->company))
                    <a href="{{ route('companies.edit', $onboarding->company->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Rediger firma
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <span class="text-muted">Intet firma</span>
@endif

<style>
a[data-bs-toggle="modal"]:hover {
    cursor: pointer;
    opacity: 0.8;
}

.badge {
    font-size: 0.85em;
}
</style>