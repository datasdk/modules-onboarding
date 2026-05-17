@extends('layouts.app')

@section('actions')
    <a href="{{ route('onboarding.badges.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Opret Badge
    </a>
@endsection

@section('content')

    <livewire:table 
         :config="Modules\Onboarding\Tables\BadgeTable::class" 
    />
    
@endsection
