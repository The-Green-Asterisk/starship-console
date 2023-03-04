@extends('index', ['starship' => $starship])

@section('main')
    <div class="heading">
        <h1>DM Dashboard</h1>
    </div>
    @include('components.nav-buttons', ['current' => 'dashboard'])
    <div class="dash sections">
        <label for="dm-mode" class="checkbox-label" style="width: fit-content">
            <input type="checkbox" id="dm-mode" name="dm-mode" class="dm-mode"
                @if (auth()->user()->is_dm) checked @endif>
            <span></span>
            DM Mode
        </label>

        <h3>Active Starship:</h3>
        <div class="select-div">
            <select id="starship-select">
                @if ($starships->count() <= 0)
                    <option value="" disabled selected>No starships available. Click the plus button to add one.
                    </option>
                @endif
                @foreach ($starships as $ship)
                    <option value="{{ $ship->id }}" @if ($ship->id == $starshipId) selected @endif>
                        {{ $ship->name }}</option>
                @endforeach
            </select>
            <button id="new-starship" title="Add new starship">&NonBreakingSpace;+&NonBreakingSpace;</button>
            <button id="edit-starship" title="Edit starship">&#9998;</button>
            <button id="delete-starship" title="Delete starship">&NonBreakingSpace;x&NonBreakingSpace;</button>
        </div>
        @foreach ($characters as $character)
            @if ($character)
                <h3>{{ $character->name }}'s Division(s)</h3>
                <a href="/disembark/{{ $character->id }}"><small>Remove character from ship</small></a>
                <div class="division-checkboxes">
                    @foreach ($divisions as $division)
                        <label for="{{ $character->id }}-{{ $division->id }}" class="checkbox-label division-checkboxes">
                            <input type="checkbox" id="{{ $character->id }}-{{ $division->id }}"
                                name="{{ $character->id }}-{{ $division->name }}" value="{{ $division->id }}"
                                {{ $character->divisions->contains($division->id) ? 'checked' : '' }}>
                            <span></span>
                            <input type="hidden" id="division-character-id" value="{{ $character->id }}">
                            {{ $division->name }}</label>
                    @endforeach
                </div>
            @endif
        @endforeach
        <input type="email" name="email" id="email-invite" placeholder="Invite user aboard by email address">
        <x-color-select></x-color-select>
    </div>
@endsection
