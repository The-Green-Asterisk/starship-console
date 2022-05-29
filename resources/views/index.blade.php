@extends('layout')

@section('content')
    <div class="buttons">
        <button id="fire-button">Fire!</button>
        @include('components.hp', ['system' => $starship, 'detail' => true])
        <a href="/reset/1" class="btn">Reset</a>
    </div>
    @include('components.dice')
    <div class="heading">
        <h1>Systems Overview</h1>
    </div>
    <div class="sections">
        @foreach ($divisions as $division)
            <section name="{{ $division->name }}">
                <h1>{{ $division->name }}</h1>
                @foreach ($division->systems as $system)
                    @include('components.hp', ['system' => $system, 'detail' => false])
                @endforeach
            </section>
        @endforeach
    </div>
@endsection

