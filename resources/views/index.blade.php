@extends('layout')

@section('content')
    <div class="buttons">
        <a href="/"><img src="{{ asset('/img/valkur-logo.svg') }}" alt="logo" class="logo"></a>
        @auth
            @if ($character)
                @include('components.hp', ['system' => $character->starship, 'detail' => true])
                <input type="hidden" value="{{ $character->starship->id }}" id="starship-id">
            @endif
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
                <button id="roll" value="{{ $character ? $character->starship->id : 0 }}">Dice</button>
                @if (auth()->user()->is_dm)
                    <a href="/starship/{{ $character->starship->id ?? 0 }}/reset-damage" class="btn">Reset</a>
                @endif
                <button id="crew">Crew</button>
            </div>
        @endauth
    </div>
    @yield('main')
    @auth
    <div class="bottom-buttons">
        @if ($character && ($character->divisions->contains(5) || $character->is_captain))
            @foreach (auth()->user()->characters->where('is_active') as $character)
                @foreach ($character->starship->divisions as $division)
                    <a class="btn bottom" href="/starship/{{ $character->starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
                @endforeach
            @endforeach
        @elseif ($character)
            @foreach ($character->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $character->starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
        @endif
        <a class="btn bottom" href="/starship/{{ $character->starship->id ?? 0 }}">Systems Overview</a>
        <a class="btn bottom" href="/dashboard">User Dashboard</a>
    </div>
    @endauth
@endsection

