@extends('components.modal')

@section('content')
    <div class="modal-header">
        <h1>Log In</h1>
    </div>
    <form method="POST" id="login-form">
        @csrf
        <label for="email" hidden>Email</label>
        <input type="email" id="email" name="email" placeholder="Email" autofocus>
        <label for="password" hidden>Password</label>
        <input type="password" id="password" name="password" placeholder="Password">
        <div id="modal-buttons">
            <button type="submit">Log In</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
        <div id="errors">

        </div>
    </form>
@endsection
