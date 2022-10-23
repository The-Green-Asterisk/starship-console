@extends('index')

@section('main')
    <div style="width: 315px; margin: 0 auto">
        <div class="modal-header" style="text-align: center">
            <h3>Reset Password</h3>
        </div>
        <form method="POST" id="reset-password" action="/reset-password">
            @csrf
            <input type="hidden" name="email" id="email" value="{{ $email }}">
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <label for="password" hidden>Password</label>
            <input type="password" name="password" id="password" placeholder="New Password" required>
            <label for="password_confirmation" hidden>Confirm Password</label>
            <input type="password" name="password_confirmation" id="password-confirmation" placeholder="Confirm New Password" required>
            <div id="errors">
            </div>
            <button type="submit" class="btn">Reset</button>
        </form>
    </div>
@endsection
