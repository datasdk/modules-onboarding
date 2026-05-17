@extends('layouts.app')

@section('actions')
<!--
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Opret firma</a>
-->
@endsection

@section('content')

    <livewire:table 
        :config="Modules\Onboarding\Tables\OnboardingTable::class" 
    />
    
@endsection