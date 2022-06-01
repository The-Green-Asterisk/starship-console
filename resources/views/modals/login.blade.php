@extends('components.modal')

@section('content')
    <h1>Log In</h1>
    <form action="/login" method="post">
        @csrf
        <input type="email" name="email" placeholder="Email" autofocus>
        <input type="password" name="password" placeholder="Password">
        <div id="modal-buttons">
            <button type="submit">Log In</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
    </form>
@endsection
