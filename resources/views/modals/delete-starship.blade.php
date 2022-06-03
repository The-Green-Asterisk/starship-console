@extends('components.modal')

@section('content')
    <form action="/delete-starship/" method="post">
        @csrf
        {{ $message }}
        @if ($yesButton)
            <select id="starship-select" name="newStarship">
                @foreach (auth()->user()->starships as $newStarship)
                    @if ($newStarship->id == $starship->id)
                        @continue
                    @endif
                    <option value="{{ $newStarship->id }}">{{ $newStarship->name }}</option>
                @endforeach
            </select>
        @endif
        <div id="modal-buttons">
            @if ($yesButton)
                <input hidden name="starship" value="{{ $starship->id }}">
                <button type="submit">Yes</button>
            @endif
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
