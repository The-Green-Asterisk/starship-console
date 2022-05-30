@extends('components.modal')

@section('content')
    <div class="modal-header">
        <h3>Register</h3>
    </div>
    <form method="POST" id="registration-form">
        @csrf
        <label for="name" hidden>Name</label>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <label for="email" hidden>Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="password" hidden>Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password_confirmation" hidden>Confirm Password</label>
        <input type="password" name="password_confirmation" id="password-confirmation" placeholder="Confirm Password" required>
        <div id="errors">
            
        </div>

        <button type="submit" class="btn">Register</button>
    </form>
@endsection
