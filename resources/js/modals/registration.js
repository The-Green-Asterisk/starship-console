window.activateRegistration = () => {
    const registrationForm = document.getElementById('registration-form');
    registrationForm.addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password-confirmation').value,
                starship: document.getElementById('starship').value
            })
        })
            .then((err) => {
                err.json()
                    .then((data) => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                        if (data.name) {
                            for (let i = 0; i < data.name.length; i++) {
                                document.querySelector('#errors').innerHTML += `<p class="error">${data.name[i]}</p>`;
                            }
                        }
                        if (data.email) {
                            for (let i = 0; i < data.email.length; i++) {
                                document.querySelector('#errors').innerHTML += `<p class="error">${data.email[i]}</p>`;
                            }
                        }
                        if (data.password) {
                            for (let i = 0; i < data.password.length; i++) {
                                document.querySelector('#errors').innerHTML += `<p class="error">${data.password[i]}</p>`;
                            }
                        }
                        if (data.error) {
                            document.querySelector('#errors').innerHTML += `<p class="error">${data.error}</p>`;
                        }
                    });
            });
    });
};
