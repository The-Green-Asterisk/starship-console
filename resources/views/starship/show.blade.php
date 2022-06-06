@extends('index')

@section('main')
    <div class="heading">
        <h1>Systems Overview</h1>
    </div>
    <div class="sections">
        @foreach ($divisions as $division)
        <section name="{{ $division->name }}">
            <div class="div-img-wrapper">
                @foreach ($characters as $char)
                    @if ($char->divisions->contains($division->id))
                        <img class="division-title" src="{{ $char->picture_url ? '/storage/' . $char->picture_url : '/storage/img/default-image.svg' }}" title="{{ $char->name }}">
                    @endif
                @endforeach
            </div>
                <h1>{{ $division->name }}</h1>
                @foreach ($division->systems as $system)
                    @include('components.hp', ['system' => $system, 'detail' => false])
                @endforeach
            </section>
        @endforeach
    </div>
@endsection
