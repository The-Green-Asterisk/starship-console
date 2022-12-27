import * as el from "./elements";
import { getSecure, starshipId } from "./app";

const closeModal = () => {
    let modal = el.modal();
    if (modal != null) {
        modal.className = 'modal fadeout';
        setTimeout(() => {
            modal.remove();
            document.removeEventListener('click', clickOutside);
        }, 350);
    }
};
const clickOutside = (ev) => {
    ev.stopImmediatePropagation();
    let dialog = el.dialog();
    if (dialog != null && !dialog.contains(ev.target)) {
        closeModal();
    }
};
const flashModal = (res, goToAfter) => {
    res.text()
        .then((data) => {
            let modal = document.createElement('div')
            modal.innerHTML = data;
            el.body.appendChild(modal.firstChild);
            setTimeout(() => {
                modal.remove();
                if (goToAfter) window.location.href = goToAfter;
            }, 3000);
        });
}

window.success = (message) => {
    fetch(`/success/${message}`, getSecure)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            flashModal(res);
        });
};

window.officerDamage = (div) => {
    let incomingModal = document.createElement('div');
    incomingModal.innerHTML = div;
    el.body.appendChild(incomingModal.firstChild);
    document.addEventListener('click', (e) => { clickOutside(e) });
    const closeButton = el.closeButton();
    closeButton.addEventListener('click', () => { closeModal() });
}

function popModal(res) {
    document.activeElement.blur();
    res.text()
        .then((data) => {
            let incomingModal = document.createElement('div');
            incomingModal.innerHTML = data;
            el.body.appendChild(incomingModal.firstChild);
            document.addEventListener('click', (e) => { clickOutside(e) });
            const closeButton = el.closeButton();
            closeButton.addEventListener('click', () => { closeModal() });
        });
}

if (el.register != null) {
    el.register.addEventListener('click', () => {
        fetch('/register', getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                document.activeElement.blur();
                res.text()
                    .then((data) => {
                        let incomingModal = document.createElement('div');
                        incomingModal.innerHTML = data;
                        el.body.appendChild(incomingModal.firstChild);
                        document.addEventListener('click', (e) => { clickOutside(e) });
                        window.activateRegistration();
                    })
            });
    });
}

if (el.login != null) {
    el.login.addEventListener('click', () => {
        fetch('/login', getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                document.activeElement.blur();
                res.text()
                    .then((data) => {
                        let incomingModal = document.createElement('div');
                        incomingModal.innerHTML = data;
                        el.body.appendChild(incomingModal.firstChild);
                        document.addEventListener('click', (e) => { clickOutside(e) });
                        const closeButton = el.closeButton();
                        closeButton.addEventListener('click', () => { closeModal() });
                        const forgotPassword = el.forgotPassword();
                        forgotPassword.addEventListener('click', () => {
                            closeModal();
                            fetch('/forgot-password', getSecure)
                                .catch((err) => {
                                    console.log(err);
                                    alert('Something went wrong');
                                })
                                .then((res) => {
                                    res.text()
                                        .then((data) => {
                                            let incomingModal = document.createElement('div');
                                            incomingModal.innerHTML = data;
                                            el.body.appendChild(incomingModal.firstChild);
                                            document.addEventListener('click', (e) => { clickOutside(e) });
                                            const closeButton = el.closeButton();
                                            closeButton.addEventListener('click', () => { closeModal() });
                                            document.getElementById('forgot-password-form').addEventListener('submit', (e) => {
                                                e.preventDefault();
                                                let email = document.getElementById('email').value;
                                                fetch(`/forgot-password`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                    },
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
                                            });
                                        });
                                });
                        });
                        window.activateLogin();
                    });
            });
    });
}

if (el.roll != null) {
    el.roll.addEventListener('click', () => {
        fetch(`/roll/${el.roll.value}`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                return res.text()
            })
            .then((data) => {
                let incomingModal = document.createElement('div');
                incomingModal.innerHTML = data;
                el.body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => { clickOutside(e) });
                let close = el.closeButton();
                close.addEventListener('click', () => {
                    // rollValue = 0;
                    closeModal();
                });
                window.activateDice();
            });
    });
}

if (el.newCharacter != null) {
    el.newCharacter.addEventListener('click', () => {
        fetch('/new-character', getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.editCharacter != null) {
    el.editCharacter.addEventListener('click', () => {
        fetch(`/edit-character/${el.characterSelect.value}`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.deleteCharacter != null) {
    el.deleteCharacter.addEventListener('click', () => {
        fetch(`/delete-character/${el.characterSelect.value}`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.newStarship != null) {
    el.newStarship.addEventListener('click', () => {
        fetch('/new-starship', getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.editStarship != null) {
    el.editStarship.addEventListener('click', () => {
        fetch(`/edit-starship/${starshipId}`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.deleteStarship != null) {
    el.deleteStarship.addEventListener('click', () => {
        fetch(`/delete-starship/${starshipId}`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.crew != null) {
    el.crew.addEventListener('click', () => {
        fetch(`/starship/${starshipId}/crew-manifest`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.newSystem != null) {
    el.newSystem.addEventListener('click', () => {
        fetch(`/starship/${starshipId}/division/${el.newSystem.value}/new-system`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.editSystemButtons != null) {
    for (let i = 0; i < el.editSystemButtons.length; i++) {
        el.editSystemButtons[i].addEventListener('click', () => {
            let systemId = el.editSystemButtons[i].value;
            fetch(`/edit-system/${systemId}`, getSecure)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        });
    }
}

if (el.welcomeLogo != null) {
    el.welcomeLogo.addEventListener('click', () => {
        fetch('/orientation', getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

export {
    clickOutside,
    closeModal,
    flashModal
};
