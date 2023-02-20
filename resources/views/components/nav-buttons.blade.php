
    @auth
    <div class="bottom-buttons">
        @if ((!auth()->user()->is_dm && $character) && ($character->divisions->contains(5) || $character->isCaptain()))
            @foreach ($character->starship->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $character->starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
            <a class="btn bottom" href="/starship/{{ $character->starship->id ?? 0 }}">Systems Overview</a>
            <a class="btn bottom" href="/dashboard">Dashboard</a>
        @elseif ((!auth()->user()->is_dm && $character))
            @foreach ($character->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $character->starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
            <a class="btn bottom" href="/starship/{{ $character->starship->id ?? 0 }}">Systems Overview</a>
            <a class="btn bottom" href="/dashboard">Dashboard</a>
        @elseif (auth()->user()->is_dm)
            @foreach ($starship->divisions as $division)
                <a class="btn bottom" href="/starship/{{ $starship->id }}/division/{{ $division->id }}">{{ $division->name }}</a>
            @endforeach
            <a class="btn bottom" href="/starship/{{ $starship->id ?? 0 }}">Systems Overview</a>
            <a class="btn bottom" href="/dm-dashboard/{{ $starship->id ?? 0 }}">Dashboard</a>
        @endif
    </div>
    @endauth
