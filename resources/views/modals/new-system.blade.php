@extends('components.modal')

@section('content')
    <h1>New System</h1>
    <p>For the {{ $starship->name }}'s {{ $division->name }} division</p>
    <form action="/starship/{{ $starship->id }}/division/{{ $division->id }}/new-system" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" required autofocus>
        <textarea name="description" rows="5" placeholder="Description"></textarea>
        <textarea name="division_action" rows="5" placeholder="Any Division Actions go here. Default formatting is to wrap the name of a Division Action in an '<h3>' tag, and the body in a '<p>' tag like this:&#10;<h3>Division Action</h3>&#10;<p>Description of action</p>"></textarea>
        <input type="number" name="max_hp" placeholder="Max HP">
        <input type="hidden" name="starship_id" value="{{ $starship->id }}">
        <input type="hidden" name="division_id" value="{{ $division->id }}">
        <div id="modal-buttons">
            <button type="submit">Create</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
