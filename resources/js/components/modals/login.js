export default function login(el, closeModal, popModal, flashModal) {
    const forgotPassword = el.forgotPassword();
    const loginForm = el.loginForm();
    const seePass = el.seePass();

    loginForm.onsubmit = (e) => {
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
    };

    seePass.onclick = () => {
        const pass = document.getElementById('password');
        if (pass.type === 'password') {
            pass.type = 'text';
        } else {
            pass.type = 'password';
        }
    };

    forgotPassword.onclick = async () => {
        fetch('/forgot-password')
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then(async (res) => {
                await closeModal();
                await popModal(res)
                    .then(() => {
                        const forgotPasswordForm = el.forgotPasswordForm();
                        forgotPasswordForm.onsubmit = (e) => {
                            e.preventDefault();
                            let email = el.forgotPasswordEmail();
                            fetch(`/forgot-password`, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({
                                    email: email,
                                })
                            })
                                .catch((err) => {
                                    console.log(err);
                                    alert('Something went wrong');
                                })
                                .then((res) => {
                                    flashModal(res, '/');
                                });
                        };
                    });
            });
    };
};
