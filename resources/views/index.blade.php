@extends('layout')

@section('content')
    <div class="buttons">
        <a href="/"><img src="{{ asset('/img/valkur-logo.svg') }}" alt="logo" class="logo"></a>
        @auth
            @foreach (auth()->user()->characters->where('is_active') as $character)
                @include('components.hp', ['system' => $character->starship, 'detail' => true])
            @endforeach
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
                <button id="roll" value="{{ auth()->user()->characters->where('is_active')->first()->starship->id ?? 0 }}">Dice</button>
                <a href="/starship/{{ auth()->user()->characters->where('is_active')->first()->starship->id ?? 0 }}/reset-damage" class="btn">Reset</a>
            </div>
        @endauth
    </div>
    @yield('main')
    @auth
    <div class="bottom-buttons">
        <a class="btn bottom" href="/starship/{{ auth()->user()->characters->where('is_active')->first()->starship->id ?? 0 }}">Systems Overview</a>
        <a class="btn bottom" href="/dashboard">User Dashboard</a>
    </div>
    @endauth
@endsection

