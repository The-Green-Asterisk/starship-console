@extends('components.modal')

@section('content')
    <p style="color: red">WARNING! DAMAGE TAKEN!</p>
    @if ($pilot > 0)
        <p>The pilot has recieved {{ $pilot }} damage!</p>
    @endif
    @if ($ops > 0)
        <p>The operations officer has recieved {{ $ops }} damage!</p>
    @endif
    @if ($def > 0)
        <p>The defense officer has recieved {{ $def }} damage!</p>
    @endif
    @if ($life > 0)
        <p>The life support officer has recieved {{ $life }} damage!</p>
    @endif
    @if ($eng > 0)
        <p>The engineering officer has recieved {{ $eng }} damage!</p>
    @endif
    @if ($comms > 0)
        <p>The communications officer has recieved {{ $comms }} damage!</p>
    @endif

    <button type="button" id="close-button">Okay</button>
@endsection
