import { getSecure } from "../app";

window.activateCrew = () => {
    let emailInvite = document.getElementById('email-invite');
    emailInvite.addEventListener('blur', (e) => {
        fetch(`/starship/add-user/${emailInvite.value}`, getSecure)
            .then(res => res.json()
                .then(data => {
                    window.success(data.message);
                })
            )
    });
};
