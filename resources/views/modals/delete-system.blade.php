@extends('components.modal')

@section('content')
    <form action="/delete-system/" method="post">
        @csrf
        {{ $message }}
        <div id="modal-buttons">
            @if ($yesButton)
                <input hidden name="system" value="{{ $system->id }}">
                <button type="submit">Yes</button>
            @endif
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
