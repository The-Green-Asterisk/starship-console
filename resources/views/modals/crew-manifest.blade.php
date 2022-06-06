@extends('components.modal')

@section('content')
    <div class="header">
        <h2>Crew Manifest</h2>
    </div>
    @if ($crew->count() > 0)
        @foreach ($crew as $crewmember)
            <div class="crew-members">
                <img src="{{ '/storage/' . ($crewmember->picture_url ?? 'img/default-image.svg') }}" alt="{{ $crewmember->name }}">
                <p>{{ $crewmember->name }}</p>
                <p>{{ $crewmember->division }}</p>
                <div style="flex-grow: 1;"></div>
                <div class="manifest-divisions">
                    @foreach ($divisions as $division)
                        @if ($crewmember->divisions->contains($division->id))
                            <p>{{ $division->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
        <h1>Captain</h1>
        <img class="captain-image" src="{{ '/storage/' . ($captain->picture_url ?? 'img/default-image.svg') }}" alt="{{ $captain->name ?? '' }}">
        <h3>{{ $captain->name ?? '' }}</h3>
    @else
        <p>No crew members found.</p>
    @endif
    <button id="close-button">Okay</button>
@endsection
