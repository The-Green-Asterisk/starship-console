@extends('components.modal')

@section('content')
    <h1>New Character</h1>
    <form action="/new-character" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" required autofocus>
        <input type="number" name="engineering_mod" placeholder="Engineering Mod">
        <select name="starship_id" required>
            <option value="" selected disabled>Starship</option>
            @if (auth()->user()->starships->count() <= 0)
                <option value="" disabled>You must be invited to a starship before you can create a character.</option>
            @else
                @foreach (auth()->user()->starships as $starship)
                    <option value="{{ $starship->id }}">{{ $starship->name }}</option>
                @endforeach
            @endif
        </select>
        <div id="modal-buttons">
            <button type="submit">Create</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
