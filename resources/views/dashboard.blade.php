@extends('index')

@section('main')
    <div class="heading">
        <h1>User Dashboard</h1>
    </div>
    <div class="dash sections">
        <h3>Active Character:</h3>
        <div class="select-div">
            <select id="character-select">
                @foreach (auth()->user()->characters as $character)
                    <option value="{{ $character->id }}" {{ $character->is_active == true ? 'selected' : '' }}>{{ $character->name }}</option>
                @endforeach
            </select>
            <button id="new-character" title="Add new character">&NonBreakingSpace;+&NonBreakingSpace;</button>
            <button id="edit-character" title="Edit character">&#9998;</button>
            <button id="delete-character" title="Delete character">&NonBreakingSpace;x&NonBreakingSpace;</button>
        </div>
        <h3>{{ auth()->user()->characters->where('is_active')->first()->name }}'s Starship:</h3>
        <div class="select-div">
            <select id="starship-select">
                @foreach (auth()->user()->starships as $starship)
                    <option value="{{ $starship->id }}" {{ auth()
                                                            ->user()
                                                            ->characters
                                                            ->where('is_active')
                                                            ->first()
                                                            ->starship
                                                            ->id == $starship->id ? 'selected' : '' }}>{{ $starship->name }}</option>
                @endforeach
            </select>
            <button id="new-starship" title="Add new starship">&NonBreakingSpace;+&NonBreakingSpace;</button>
            <button id="edit-starship" title="Edit starship">&#9998;</button>
            <button id="delete-starship" title="Delete starship">&NonBreakingSpace;x&NonBreakingSpace;</button>
        </div>

        @if (auth()->user()->characters->where('is_active'))
            <h3>{{ auth()
                    ->user()
                    ->characters
                    ->where('is_active')
                    ->first()
                    ->name }}'s Division(s)</h3>
            <div class="division-checkboxes">
            @foreach ($divisions as $division)
                    <label for="{{ $division->id }}" class="container">
                        <input class="div-check"
                        type="checkbox"
                        id="{{ $division->id }}"
                        name="{{ $division->name }}"
                        value="{{ $division->id }}"
                        {{ auth()
                            ->user()
                            ->characters
                            ->where('is_active')
                            ->first()
                            ->divisions
                            ->contains($division->id) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    {{ $division->name }}</label>
                @endforeach
            </div>
        @endif
    </div>
@endsection
