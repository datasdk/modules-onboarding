@extends('onboarding::layouts.app')

@section('content')
<div class="container mt-5">
    
    <h2>{{ __('onboarding::onboarding.accepted_title') }}</h2>
    <p>{!! __('onboarding::onboarding.accepted_greeting', ['first_name' => $onboarding->user->first_name]) !!}</p>
    <p>{!! __('onboarding::onboarding.accepted_message', ['company' => $onboarding->company->name, 'vat' => $onboarding->company->vat]) !!}</p>
    <p>{{ __('onboarding::onboarding.accepted_access') }}</p>
</div>
@endsection
