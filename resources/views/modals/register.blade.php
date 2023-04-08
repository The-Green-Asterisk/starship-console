@extends(request()->query() != null ? 'layout' : 'components.modal')

@section('content')
    <div class="modal-header">
        <h3>Register</h3>
    </div>
    <form method="POST" id="registration-form">
        @csrf
        <input type="hidden" name="starship" value="{{ request()->query('starship') }}">
        <label for="name" hidden>Name</label>
        <input type="text" name="name" id="name" placeholder="Name" required autofocus>
        <label for="email" hidden>Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="password" hidden>Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password_confirmation" hidden>Confirm Password</label>
        <input type="password" name="password_confirmation" id="password-confirmation" placeholder="Confirm Password"
            required>
        <div id="errors">

        </div>

    </form>
    <div class="modal-buttons">
        <button type="submit" class="btn" form="registration-form">Register</button>
        <button type="button" class="btn" id="close-button">Cancel</button>
    </div>
@endsection
