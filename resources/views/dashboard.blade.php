@extends('index')

@section('main')
    @if (auth()->user()->characters->count() > 0)
        <div class="heading">
            <h1>User Dashboard</h1>
        </div>
        <div class="dash sections">
            <form action="/img/upload/" method="POST" name="characterImage" enctype="multipart/form-data">
                @csrf
                <label for="character-image">
                    <img src="{{ '/storage/' . ($character->picture_url ?? 'img/default-image.svg') }}" alt=" " class="character-image">
                </label>
                <input type="file" id="character-image" name="character-image" class="character-image">
            </form>
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
            <h3>{{ $character->name }}'s Starship:</h3>
            <div class="select-div">
                <select id="starship-select">
                    @foreach (auth()->user()->starships as $starship)
                        <option value="{{ $starship->id }}" {{ $character->starship->id == $starship->id ? 'selected' : '' }}>{{ $starship->name }}</option>
                    @endforeach
                </select>
                @if (auth()->user()->is_dm)
                    <button id="new-starship" title="Add new starship">&NonBreakingSpace;+&NonBreakingSpace;</button>
                    <button id="edit-starship" title="Edit starship">&#9998;</button>
                    <button id="delete-starship" title="Delete starship">&NonBreakingSpace;x&NonBreakingSpace;</button>
                @endif
            </div>

            @if ($character)
                <h3>{{ $character->name }}'s Division(s)</h3>
                <div class="division-checkboxes">
                @foreach ($divisions as $division)
                        <label for="{{ $division->id }}" class="checkbox-label">
                            <input
                            type="checkbox"
                            id="{{ $division->id }}"
                            name="{{ $division->name }}"
                            value="{{ $division->id }}"
                            {{ $character->divisions->contains($division->id) ? 'checked' : '' }}>
                            <span></span>
                        {{ $division->name }}</label>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div class="heading">
            <h1>User Dashboard</h1>
        </div>
        <div class="dash sections">
            <h3>No active characters</h3>
            <button id="new-character" title="Add new character">&NonBreakingSpace;+&NonBreakingSpace;</button>
            <div class="select-div">
                <select id="starship-select">
                    @foreach (auth()->user()->starships as $starship)
                        <option value="{{ $starship->id }}" {{ $character->starship->id == $starship->id ? 'selected' : '' }}>{{ $starship->name }}</option>
                    @endforeach
                </select>
                @if (auth()->user()->is_dm)
                    <button id="new-starship" title="Add new starship">&NonBreakingSpace;+&NonBreakingSpace;</button>
                    <button id="edit-starship" title="Edit starship">&#9998;</button>
                    <button id="delete-starship" title="Delete starship">&NonBreakingSpace;x&NonBreakingSpace;</button>
                @endif
            </div>
        </div>
    @endif
@endsection
