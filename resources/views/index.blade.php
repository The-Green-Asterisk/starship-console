@extends('layout')

@section('content')
    <div class="buttons">
        @include('components.hp', ['system' => $starship, 'detail' => true])
        <a href="/starship/{{ $starship->id }}/reset-damage" class="btn">Reset</a>
        <button id="login">Log In</button>
        <button id="roll" value="{{ $starship->id }}">Roll</button>
    </div>
    @yield('main')
@endsection

