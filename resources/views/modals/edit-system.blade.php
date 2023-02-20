@extends('components.modal')

@section('content')
    <h1>Edit System</h1>
    <form action="/edit-system" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" value="{{ $system->name }}" required autofocus>
        <textarea name="description" rows="5" placeholder="Description (Optional)">{{ $system->description }}</textarea>
        <textarea name="division_action" rows="5" placeholder="Division Action (Optional)">{{ $system->division_action ?? '<h3>Division Action</h3><p>Description of action</p>' }}</textarea>
        <div style="display:flex;white-space:nowrap;align-items:center">
            <p style="whitespace:nowrap;">Current HP:</p>
            <input type="number" name="current_hp" placeholder="Current HP" value="{{ $system->current_hp }}" required>
            <p style="">Max HP:</p>
            <input type="number" name="max_hp" placeholder="Max HP" value="{{ $system->max_hp }}" required>
        </div>
        <div id="modal-buttons">
            <input hidden name="system_id" value="{{ $system->id }}">
            <button type="submit">Update</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
