@extends('components.modal')

@section('content')
    <h1>Edit Starship</h1>
    <form action="/edit-starship" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" value="{{ $starship->name }}" required autofocus>
        <input type="text" name="model" placeholder="Model (Optional)" value="{{ $starship->model }}">
        <input type="text" name="manufacturer" placeholder="Manufacturer (Optional)" value="{{ $starship->manufacturer }}">
        <select name="captain_id">
            <option value="" disabled>Captain</option>
            @foreach ($characters as $character)
                @if ($character->id == $starship->captain_id)
                    <option value="{{ $character->id }}" selected>{{ $character->name }}</option>
                @else
                    <option value="{{ $character->id }}">{{ $character->name }}</option>
                @endif
            @endforeach
            <option value="">No captain</option>
        </select>
        <div id="modal-buttons">
            <input hidden name="starship_id" value="{{ $starship->id }}">
            <button type="submit">Update</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
