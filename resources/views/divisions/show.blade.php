@extends('index')

@section('main')
<div class="heading">
    <h1>{{ $division->name }}</h1>
</div>
<p style="text-align: center">If systems reach 0% they will be irreparable without first stopping at a ship yard for replacement parts.</p>
<div class="sections">
    @foreach ($systems as $system)
        <div class="systems">
            @include('components.hp', ['system' => $system, 'detail' => true])
            <button class="quick-fix" value="{{ $system->id }}"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M11 1a4 4 0 0 0-3.896 4.91l-5.051 5.235a1.986 1.986 0 0 0 2.842 2.774l5.007-5.072a4.002 4.002 0 0 0 5.062-4.382a.5.5 0 0 0-.85-.287L12 6.293L9.707 4l2.115-2.115a.5.5 0 0 0-.287-.85A4.032 4.032 0 0 0 10.999 1Z"/></svg></button>
            <button class="focused-repairs" value="{{ $system->id }}"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 640 512"><path fill="currentColor" d="M286.3 155.1c1.1 6.8 1.7 13.8 1.7 20c0 8-.6 15-1.7 21.8l22.2 19.8c7 6.3 9.9 15.4 6.2 25c-2.3 4.4-4.8 10.5-7.6 15.5l-3.1 5.4c-3.9 5-6.3 9.8-9.8 14.5c-5.7 7.6-15.7 10.1-24.7 7.1l-28.3-9.3c-10.7 8.9-22.9 16-36.2 21l-6.9 29c-1.1 9.3-8.3 16.7-17.7 17.9c-6.7.8-13.5 1.2-20.4 1.2c-6.9 0-13.7-.4-20.4-1.2c-9.4-1.2-17.5-8.6-18.6-17.9l-6.9-29c-12.4-5-24.6-12.1-35.35-21l-28.22 9.3c-8.99 3-19.01.5-24.71-7.1c-3.54-4.7-6.84-9.6-9.88-14.6l-3.02-5.3c-2.79-5-5.328-10.2-7.596-15.5c-3.704-9.6-.866-18.7 6.196-25l22.18-19.8c-1.12-6.8-2.6-13.8-2.6-21.8c0-6.2 1.48-13.2 2.6-20l-22.18-19.8c-7.062-7.2-9.9-16.3-6.196-25c2.268-6.2 4.806-10.51 7.586-15.54l3.04-5.25c3.03-5.05 6.33-9.93 9.87-14.62c5.7-7.55 15.72-10.06 24.71-7.1l28.22 9.3c10.75-8.84 22.95-15.96 35.35-20.94l6.9-29.07c1.1-9.28 9.2-16.71 18.6-17.849A169.2 169.2 0 0 1 160 8c6.9 0 13.7.418 20.4 1.23c9.4 1.14 16.6 8.57 17.7 17.85l6.9 29.07c13.3 4.98 25.5 12.1 36.2 20.94l28.3-9.3c9-2.96 19-.45 24.7 7.1c3.5 4.67 5.9 9.53 9.8 14.55l3.1 5.39c2.8 5.01 5.3 10.17 7.6 15.47c3.7 8.7.8 17.8-6.2 25l-22.2 19.8zm-126.3-28c-26.5 0-48 22.4-48 48c0 27.4 21.5 48 48 48s48-20.6 48-48c0-25.6-21.5-48-48-48zm324.9 351.2c-6.8 1.1-13.8 1.7-20.9 1.7c-7.1 0-14.1-.6-20.9-1.7l-19.8 22.2c-7.2 7-16.3 9.9-25 6.2c-5.3-2.3-10.5-4.8-15.5-7.6l-5.4-3.1c-5-3.9-9.8-6.3-14.5-9.8c-7.6-5.7-10.1-15.7-7.1-24.7l9.3-28.3c-8.9-10.7-16-22.9-21-36.2l-29-6.9c-9.3-1.1-16.7-8.3-17.9-17.7c-.8-6.7-1.2-13.5-1.2-20.4c0-6.9.4-13.7 1.2-20.4c1.2-9.4 8.6-17.5 17.9-18.6l29-6.9c5-12.4 12.1-24.6 21-35.3l-9.3-28.3c-3-9-.5-19 7.1-24.7c4.7-3.5 9.6-7.7 14.6-9.9l5.3-3c5-2.8 9.3-5.3 15.5-7.6c8.7-3.7 17.8-.8 25 6.2l19.8 22.2c6.8-1.1 13.8-1.7 20.9-1.7c7.1 0 14.1.6 20.9 1.7l19.8-22.2c6.3-7 15.4-9.9 25-6.2c5.3 2.3 10.5 4.8 15.5 7.6l5.3 3c5 2.2 9.9 6.4 14.6 9.9c7.6 5.7 10.1 15.7 7.1 24.7l-9.3 28.3c8.9 10.7 16 22.9 21 35.3l29 6.9c9.3 1.1 16.7 9.2 17.9 18.6c.8 6.7 1.2 13.5 1.2 20.4c0 6.9-.4 13.7-1.2 20.4c-1.2 9.4-8.6 16.6-17.9 17.7l-29 6.9c-5 13.3-12.1 25.5-21 36.2l9.3 28.3c3 9 .5 19-7.1 24.7c-4.7 3.5-9.5 5.9-14.5 9.8l-5.4 3.1c-5 2.8-11.1 5.3-15.5 7.6c-9.6 3.7-18.7.8-25-6.2l-19.8-22.2zM512 352c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48z"/></svg></button>
        </div>
    @endforeach
    <div class="systems">
        <div style="max-width: fit-content;">
            <h2>Division Actions</h2>
            @if ($division->id == 1)
                <p>The Pilot is in charge of where the starship goes after consulting with the captain and crew.</p>
                <h3>Evasive maneuvers</h3>
                <p>Impose disadvantage on enemeny combatants by weaving through space in a random pattern. DC 14 Dexterity (Piloting) skill check.</p>
            @elseif ($division->id == 2)
                <h3>Sweep the System</h3>
                <p>Use sensors to make a Wisdom (Perception) check for anything that might be in the same star system as the ship.</p>
                <h3>Grapple</h3>
                <p>Use the Grapplers to attempt to grapple anything on the ship's exterior within range. The target can make a DC 15 Dexterity save to avoid being grappled.</p>
            @elseif ($division->id == 3)
                <h3>Fire Weapons</h3>
                <p>Pick any ship's system with an attack roll that you have access to and make two attacks with it.</p>
            @elseif ($division->id == 4)
                <h3>Healing Scan</h3>
                <p>Use equipment from the Medical Bay to give 2d4 + your Wisdom (Medicine) bonus HP to a crewmember.</p>
            @elseif ($division->id == 5)
                <p>The Engineering officer may access any system from any division to affect repairs throughout the ship.</p>
                <h3>Divert Power</h3>
                <p>Shut down one system to divert its power to another system giving advantage on any rolls related to the receiving system and temporarily ignoring its damaged effect. This lasts for one minute.</p>
                <h3>Power Down</h3>
                <p>Cut power to all systems to add +10 to all ship stealth checks with the ability to immediately power them back on in case of detection.</p>
            @elseif ($division->id == 6)
                <h3>Hack</h3>
                <p>Use the ship's networking system to hack into remote systems in one action. The remote creature must make a DC 14 Wisdom saving throw to counter the attack. Upon success, the Comms officer may use any available spell against any creature connected to the hacked ship or the ship itself ignoring range or sight requirement. The hack lasts until it is dropped or concentration is lost. The Comms officer must make a concentration check after every time the ship is hit.</p>
            @endif
        </div>
    </div>
</div>


@endsection
