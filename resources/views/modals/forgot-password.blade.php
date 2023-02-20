@extends('components.modal')

@section('content')
    <div class="modal-header">
        <h1>Reset Password</h1>
    </div>
    <form method="POST" id="forgot-password-form">
        @csrf
        <label for="email" hidden>Email</label>
        <input type="email" id="email" name="email" placeholder="Email" autofocus>
        <div id="modal-buttons">
            <button type="submit">Reset Password</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
        <div id="errors">

        </div>
    </form>
@endsection
