@extends('index')

@section('main')
    @if (auth()->user()->characters->count() > 0)
        <div class="heading">
            <h1>User Dashboard</h1>
        </div>
        @include('components.nav-buttons')
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
                    @if ($character->picture_url)
                        <img src="/storage/{{ $character->picture_url }}" alt=" " class="character-image">
                    @else
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="character-image" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                        <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                        <g><g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)"><path fill="currentColor" d="M4669.2,5010.6c-37-3.9-151.8-17.5-253-29.2c-1858.3-212.1-3510.3-1582-4092.1-3393.6C150.9,1050.8,86.7,585.7,102.2-7.8c11.7-453.4,42.8-690.8,140.1-1072.2c89.5-346.4,177.1-581.8,358-951.5c546.8-1115,1498.3-1984.8,2665.8-2440.1c1469.1-572.1,3144.5-377.5,4458,519.5c303.5,208.2,476.7,350.3,721.9,599.3c412.5,418.4,667.4,766.7,914.6,1241.5c251,484.5,400.9,943.7,494.3,1510c44.7,262.7,58.4,854.2,31.1,1159.7c-107,1134.4-612.9,2196.9-1438,3018C7669.7,4351,6706.5,4827.7,5603.2,4983.4C5449.5,5004.8,4785.9,5024.2,4669.2,5010.6z M5679.1,4555.3c1313.4-192.6,2498.5-978.8,3171.7-2103.5c644.1-1078,813.4-2379.8,467-3609.6c-134.3-482.6-397-1011.8-702.5-1422.4c-149.8-202.4-461.2-546.8-504-560.4c-68.1-21.4-1089.7,451.4-1492.5,690.8c-110.9,66.2-245.2,161.5-297.7,212.1l-95.4,91.5v147.9c0,142,3.9,151.8,72,233.5c163.4,194.6,348.3,529.3,463.1,838.7c35,93.4,91.5,200.4,122.6,237.4c147.9,167.4,217.9,361.9,217.9,601.3c0,173.2-19.5,258.8-89.5,412.5c-44.8,101.2-46.7,114.8-46.7,644.1c0,451.4-5.8,570.1-37,716.1c-181,875.6-865.9,1371.8-1903,1371.8c-282.1,0-478.7-25.3-704.4-89.5c-484.5-140.1-854.2-441.7-1062.4-869.8c-149.8-311.3-169.3-420.3-182.9-1113l-13.6-603.2l-54.5-124.5c-130.4-297.7-70.1-683,144-937.9c48.6-58.4,99.2-157.6,145.9-282.1c109-295.8,268.5-579.9,441.7-788.1c72-89.5,73.9-95.4,73.9-247.1c0-155.7,0-157.6-72-229.6c-124.5-120.6-348.3-254.9-774.4-465.1c-560.4-278.3-1035.2-480.6-1078-459.2c-38.9,21.4-288,295.8-433.9,478.7c-385.3,484.5-700.5,1152-840.6,1780.5c-81.7,373.6-99.2,548.7-99.2,1011.8c0,323,9.7,496.2,35,661.6c231.6,1490.5,1132.5,2726.1,2455.7,3366.3c542.9,262.7,1080,406.7,1712.4,455.3C4914.4,4617.5,5430,4592.2,5679.1,4555.3z M5369.7,2626.9c323-38.9,572.1-132.3,766.7-284.1c198.5-153.7,350.3-443.7,400.8-764.7c9.7-70.1,19.5-389.2,19.5-710.2V284.1l66.2-107c157.6-256.9,132.3-449.5-85.6-636.3c-60.3-52.5-85.6-99.2-144-270.5c-118.7-342.5-245.2-572.1-455.3-823.1l-120.6-142.1v-262.7c0-186.8,7.8-280.2,29.2-328.8c44.7-105.1,235.4-280.2,498.1-455.3c221.8-145.9,865.9-482.6,1241.5-648l165.4-72l-116.7-83.7c-679.1-490.4-1531.4-788.1-2368.1-827c-953.5-46.7-1827.2,163.4-2582.1,618.8C2478.1-3629,2268-3483,2279.7-3471.4c3.9,3.9,173.2,81.7,375.5,173.2c667.4,303.5,1122.8,568.2,1366,795.8c186.8,175.1,200.4,212.1,200.4,529.3c0,161.5-7.8,282.2-21.4,307.4c-13.6,23.4-60.3,83.7-107,134.3c-173.2,186.8-344.4,500.1-447.5,821.2c-48.6,147.9-70.1,184.9-149.8,262.7c-136.2,128.4-175.1,214-165.4,363.9c5.8,95.3,21.4,142,77.8,233.5l70,114.8l7.8,651.9c7.8,587.7,13.6,667.4,50.6,803.6c140.1,511.8,494.3,807.5,1072.2,899C4817.1,2650.3,5151.7,2654.2,5369.7,2626.9z"/></g></g>
                        </svg>
                    @endif
                </label>
                <input type="file" id="character-image" name="character-image" class="character-image">
            </form>
            <h3>Active Character:</h3>
            <div class="select-div">
                <select id="character-select">
                    @foreach (auth()->user()->characters as $char)
                        <option value="{{ $char->id }}" {{ $char->is_active == true ? 'selected' : '' }}>{{ $char->name }}</option>
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
            <x-color-select></x-color-select>
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
            @if (auth()->user()->starships->count() > 0)
                <button id="new-character" title="Add new character">&NonBreakingSpace;+&NonBreakingSpace;</button>
            @endif
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
            </div>
            <x-color-select></x-color-select>
        </div>
    @endif
@endsection
