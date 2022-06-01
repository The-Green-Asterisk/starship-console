@extends('layout')

@section('content')
    <div class="buttons">
        <a href="/"><img src="{{ asset('/img/valkur-logo.png') }}" alt="logo" class="logo"></a>
        @auth
            @foreach (auth()->user()->characters->where('is_active') as $character)
                @include('components.hp', ['system' => $character->starship, 'detail' => true])
            @endforeach
        @endauth
        @guest
            <div style="width:100%"></div>
            <button id="login">Log In</button>
            <button id="register">Register</button>
        @endguest
        @auth
            <a href="/logout" class="btn">Log Out</a>
            <button id="roll" value="{{ auth()->user()->characters->where('is_active')->first()->starship->id }}">Dice</button>
            <a href="/starship/{{ auth()->user()->characters->where('is_active')->first()->starship->id }}/reset-damage" class="btn">Reset</a>
        @endauth
    </div>
    @yield('main')
    @auth
    <div class="buttons">
        <a class="btn bottom" href="/starship/{{ auth()->user()->characters->where('is_active')->first()->starship->id }}">Systems Overview</a>
        <a class="btn bottom" href="/dashboard">User Dashboard</a>
    </div>
    @endauth
@endsection

