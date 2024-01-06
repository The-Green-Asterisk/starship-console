export default function registration(el) {
    const registrationForm = el.registrationForm();
    registrationForm.onsubmit = (e) => {
        e.preventDefault();
        fetch('/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: registrationForm.querySelector('#name').value,
                email: registrationForm.querySelector('#email').value,
                password: registrationForm.querySelector('#password').value,
                password_confirmation: registrationForm.querySelector('#password-confirmation').value,
                starship: registrationForm.querySelector('#starship')?.value
            })
        })
            .then((err) => {
                err.json()
                    .then((data) => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                        if (data.name) {
                            data.name.forEach((error) => {
                                registrationForm.querySelector('#errors').innerHTML += `<p class="error">${error}</p>`;
                            });
                        }
                        if (data.email) {
                            data.email.forEach((error) => {
                                registrationForm.querySelector('#errors').innerHTML += `<p class="error">${error}</p>`;
                            });
                        }
                        if (data.password) {
                            data.password.forEach((error) => {
                                registrationForm.querySelector('#errors').innerHTML += `<p class="error">${error}</p>`;
                            });
                        }
                        if (data.error) {
                            data.error.forEach((error) => {
                                registrationForm.querySelector('#errors').innerHTML += `<p class="error">${error}</p>`;
                            });
                        }
                    });
            });
    };
};
