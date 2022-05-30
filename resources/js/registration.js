const registrationForm = document.getElementById('registration-form');
registrationForm.addEventListener('submit', (e) => {
    e.preventDefault();
    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            username: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password-confirmation').value
        })
    })
    .then((err) => {
        err.json()
        .then((data) => {
            for (let i = 0; i < data.name.length; i++) {
                document.querySelector('#errors').innerHTML += `<p class="error">${data.name[i]}</p>`;
            }
            for (let i = 0; i < data.email.length; i++) {
                document.querySelector('#errors').innerHTML += `<p class="error">${data.email[i]}</p>`;
            }
            for (let i = 0; i < data.password.length; i++) {
                document.querySelector('#errors').innerHTML += `<p class="error">${data.password[i]}</p>`;
            }
        });
    });
});
