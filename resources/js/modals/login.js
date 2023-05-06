export default function activateLogin() {
    const loginForm = document.getElementById('login-form');
    const seePass = document.getElementById('see-pass');

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                remember_me: document.getElementById('remember-me').checked
            })
        })
            .then((err) => {
                err.json()
                    .then((data) => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                        if (data.error) {
                            document.querySelector('#errors').innerHTML += `<p class="error">${data.error}</p>`;
                        }
                    });
            });
    });

    seePass.addEventListener('click', () => {
        const pass = document.getElementById('password');
        if (pass.type === 'password') {
            pass.type = 'text';
        } else {
            pass.type = 'password';
        }
    });
};
