window.activateLogin = () => {
    const registrationForm = document.getElementById('login-form');
    registrationForm.addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('/login',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
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
};
