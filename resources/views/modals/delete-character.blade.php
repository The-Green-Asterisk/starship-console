@extends('components.modal')

@section('content')
    <form action="/delete-character/{{ $character }}" method="post">
        @csrf
        {{ $message }}
        <div id="modal-buttons">
            @if ($yesButton)
                <button type="submit">Yes</button>
            @endif
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
