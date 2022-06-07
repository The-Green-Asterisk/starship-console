@extends('layout')

@section('content')
    <div class="buttons">
        <a href="/"><img src="{{ asset('/img/valkur-logo.svg') }}" alt="logo" class="logo"></a>
        @auth
            @include('components.hp', ['system' => $starship, 'detail' => true])
            <input type="hidden" value="{{ $starship->id ?? 0 }}" id="starship-id">
        @endauth

        @guest
            <div class="button-wrap">
                <button id="login">Log In</button>
                <button id="register">Register</button>
            </div>
        @endguest

        @auth
            <div class="button-wrap">
                <a href="/logout" class="btn">Log Out</a>
                <button id="roll" value="{{ $starship->id ?? 0 }}">Dice</button>
                @if (auth()->user()->is_dm)
                    <a href="/starship/{{ $starship->id ?? 0 }}/reset-damage" class="btn">Reset</a>
                @endif
                <button id="crew">Crew</button>
            </div>
        @endauth
    </div>
    @yield('main')
    @auth
    <div class="bottom-buttons">
        @if ((!auth()->user()->is_dm && $character) && ($character->divisions->contains(5) || $character->isCaptain()))
            @foreach ($character->starship->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $character->starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
            <a class="btn bottom" href="/starship/{{ $character->starship->id ?? 0 }}">Systems Overview</a>
            <a class="btn bottom" href="/dashboard">User Dashboard</a>
        @elseif ((!auth()->user()->is_dm && $character))
            @foreach ($character->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $character->starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
            <a class="btn bottom" href="/starship/{{ $character->starship->id ?? 0 }}">Systems Overview</a>
            <a class="btn bottom" href="/dashboard">User Dashboard</a>
        @elseif (auth()->user()->is_dm)
            @foreach ($starship->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
            <a class="btn bottom" href="/starship/{{ $starship->id ?? 0 }}">Systems Overview</a>
            <a class="btn bottom" href="/dm-dashboard/{{ $starship->id ?? 0 }}">User Dashboard</a>
        @endif
    </div>
    @endauth
@endsection

