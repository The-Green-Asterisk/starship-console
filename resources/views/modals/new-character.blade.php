@extends('components.modal')

@section('content')
    <h1>New Character</h1>
    <form action="/new-character" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" required autofocus>
        <input type="number" name="ddb_id" placeholder="D&amp;D Beyond ID (Optional)">
        <select name="starship_id" required>
            <option value="" selected disabled>Starship</option>
            @foreach (auth()->user()->starships as $starship)
                <option value="{{ $starship->id }}">{{ $starship->name }}</option>
            @endforeach
        </select>
        <div id="modal-buttons">
            <button type="submit">Create</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
