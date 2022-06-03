@extends('components.modal')

@section('content')
    <h1>New Starship</h1>
    <form action="/new-starship" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" required autofocus>
        <input type="text" name="model" placeholder="Model (Optional)">
        <input type="text" name="manufacturer" placeholder="Manufacturer (Optional)">
        <select name="captain_id">
            <option value="" selected disabled>Captain</option>
            @foreach (auth()->user()->characters as $character)
                <option value="{{ $character->id }}">{{ $character->name }}</option>
            @endforeach
        </select>
        <div id="modal-buttons">
            <button type="submit">Create</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
