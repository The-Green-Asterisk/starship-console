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
        <div class="password">
            <input type="password" id="password" name="password" placeholder="Password">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" id="see-pass" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
        </div>
        <div id="modal-buttons">
            <button type="submit">Log In</button>
            <button type="button" id="close-button">Cancel</button>
        </div>
        <div id="errors">

        </div>
    </form>
@endsection
