@extends('index')

@section('main')
    @if (auth()->user()->characters->count() > 0)
        <div class="heading">
            <h1>User Dashboard</h1>
        </div>
        <div class="dash sections">
            <label for="dm-mode" class="checkbox-label" style="width: fit-content">
                <input type="checkbox" id="dm-mode" name="dm-mode" class="dm-mode" @if (auth()->user()->is_dm) checked @endif>
                <span></span>
                DM Mode
            </label>
            <form action="/img/upload/" method="POST" name="characterImage" enctype="multipart/form-data">
            @csrf
                <label for="character-image" id="character-image-wrapper">
                    <div id="overlay">Choose a character image</div>
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
                    @foreach (auth()->user()->starships as $ship)
                        <option value="{{ $ship->id }}" {{ $character->starship->id == $ship->id ? 'selected' : '' }}>{{ $ship->name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($character)
                <h3>{{ $character->name }}'s Division(s)</h3>
                <div class="division-checkboxes">
                @foreach ($divisions as $division)
                        <label for="{{ $division->id }}" class="checkbox-label division-checkboxes">
                            <input
                            type="checkbox"
                            id="{{ $division->id }}"
                            name="{{ $division->name }}"
                            value="{{ $division->id }}"
                            {{ $character->divisions->contains($division->id) ? 'checked' : '' }}>
                            <span></span>
                            <input type="hidden" id="division-character-id" value="{{ $character->id }}">
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
            <label for="dm-mode" class="checkbox-label" style="width: fit-content">
                <input type="checkbox" id="dm-mode" name="dm-mode" class="dm-mode" @if (auth()->user()->is_dm) checked @endif>
                <span></span>
                DM Mode
            </label>
            <h3>No active characters</h3>
            <button id="new-character" title="Add new character">&NonBreakingSpace;+&NonBreakingSpace;</button>
            <div class="select-div">
                <select id="starship-select">
                    <option value="" selected disabled>Starships</option>
                    @if (auth()->user()->starships->count() <= 0)
                        <option value="" disabled>Give your DM your registered email address to be welcomed aboard a new Starship</option>
                    @else
                        @foreach (auth()->user()->starships as $starship)
                            <option value="{{ $starship->id }}">{{ $starship->name }}</option>
                        @endforeach
                    @endif
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
