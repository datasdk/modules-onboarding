@if($company->badges->isNotEmpty())
    <div class="badge-column" style="display: flex; gap: 5px; flex-wrap: wrap; max-width: 300px;">
        @foreach($company->badges as $badge)
            <span class="badge badge-pill d-flex align-items-center mb-1" 
                  style="background-color: #6c757d; color: white; padding: 6px 10px; font-size: 12px;"
                  data-toggle="tooltip" 
                  title="{{ $badge->getTranslation('description', app()->getLocale()) }}">
                @if($badge->icon)
                    <i class="{{ $badge->icon }} mr-1"></i>
                @endif
                {{ $badge->getTranslation('name', app()->getLocale()) }}
            </span>
        @endforeach
    </div>
@else
    <span class="text-muted" style="font-size: 12px;">-</span>
@endif