@extends('index')

@section('main')
    <div class="heading">
        <h1>User Dashboard</h1>
    </div>
    <div class="sections">
        <span>Active Character: </span>
        <div class="select-div">
            <select id="character-select">
                @foreach (auth()->user()->characters as $character)
                    <option value="{{ $character->id }}" {{ $character->is_active == true ? 'selected' : '' }}>{{ $character->name }}</option>
                @endforeach
            </select>
            <button id="new-character" title="Add new character">+</button>
        </div>
        <span>Active Character's Starship: </span>
        <div class="select-div">
            <select id="starship-select">
                @foreach (auth()->user()->starships as $starship)
                    <option value="{{ $starship->id }}" {{ auth()->user()->characters->where('is_active')->first()->starship->id == $starship->id ? 'selected' : '' }}>{{ $starship->name }}</option>
                @endforeach
            </select>
            <button id="new-starship" title="Add new starship">+</button>
        </div>
    </div>
@endsection
