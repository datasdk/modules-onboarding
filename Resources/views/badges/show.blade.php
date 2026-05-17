@extends('layouts.app')

@section('actions')
    <a href="{{ route('onboarding.badges.edit', $badge) }}" class="btn btn-warning mr-2">
        <i class="fas fa-edit"></i> Rediger
    </a>
    <a href="{{ route('onboarding.badges.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Tilbage
    </a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Badge Information</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3" style="font-size: 48px; color: {{ $badge->color ?? '#6c757d' }};">
                        @if($badge->icon)
                            <i class="{{ $badge->icon }}"></i>
                        @endif
                    </div>
                    
                    <h4>{!! $badge->toHtml() !!}</h4>
                    <p class="text-muted">{{ $badge->description }}</p>
                    
                    <div class="mt-4">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $badge->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Slug:</strong></td>
                                <td><code>{{ $badge->slug }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($badge->is_active)
                                        <span class="badge badge-success">Aktiv</span>
                                    @else
                                        <span class="badge badge-danger">Inaktiv</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Oprettet:</strong></td>
                                <td>{{ $badge->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Firmaer med dette badge</h5>
                    <span class="badge badge-primary">{{ $companiesWithBadge->count() }} firmaer</span>
                </div>
                <div class="card-body">
                    @if($companiesWithBadge->isEmpty())
                        <div class="alert alert-info">
                            Ingen firmaer har dette badge endnu.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Firmanavn</th>
                                        <th>CVR</th>
                                        <th>Handling</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companiesWithBadge as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->vat }}</td>
                                        <td>
                                            <form action="{{ route('badges.remove-from-company', $badge->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Fjern badge fra dette firma?')">
                                                @csrf
                                                <input type="hidden" name="company_id" value="{{ $company->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i> Fjern
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <h6>Tildel badge til nyt firma</h6>
                    <form action="{{ route('onboarding.badges.assign-to-company', $badge->id) }}" method="POST" class="form-inline">
                        @csrf
                        <div class="form-group mr-2">
                            <select name="company_id" class="form-control" required>
                                <option value="">Vælg firma...</option>
                                @foreach($allCompanies = \Modules\Companies\Models\Companies::whereNotIn('id', $companiesWithBadge->pluck('id'))->get() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }} ({{ $company->vat }})</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tildel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection