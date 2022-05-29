@extends('index')

@section('main')
    <div class="heading">
        <h1>Systems Overview</h1>
    </div>
    <div class="sections">
        @foreach ($starship->divisions as $division)
            <section name="{{ $division->name }}">
                <h1>{{ $division->name }}</h1>
                @foreach ($division->systems as $system)
                    @include('components.hp', ['system' => $system, 'detail' => false])
                @endforeach
            </section>
        @endforeach
    </div>
@endsection
