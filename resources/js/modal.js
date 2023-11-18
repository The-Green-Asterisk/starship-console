import { starshipId } from "./app";
import * as el from "./const/elements";

const closeModal = () => {
    let modal = el.modal();
    if (modal != null) {
        modal.className = 'modal fadeout';
        return new Promise(resolve => setTimeout(() => {
            //allow 350 ms for fadeout animation to complete
            modal.remove();
            document.removeEventListener('click', clickOutside);
            resolve();
        }, 350));
    }
};
const clickOutside = (ev) => {
    ev.stopImmediatePropagation();
    let dialog = el.dialog();
    if ((dialog != null && !dialog.contains(ev.target)) && el.loader.style.display === 'none') {
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
                closeModal();
                if (goToAfter) window.location.href = goToAfter;
            }, 3000);
        });
}

window.success = (message) => {
    fetch(`/success/${message}`)
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

async function popModal(res) {
    document.activeElement.blur();
    await res.text()
        .then((data) => {
            let incomingModal = document.createElement('div');
            incomingModal.innerHTML = data;
            el.body.appendChild(incomingModal.firstChild);
            document.addEventListener('click', (e) => { clickOutside(e) });
            const closeButton = el.closeButton();
            closeButton.addEventListener('click', () => { closeModal() });
        });
}

if (el.register) {
    el.register.addEventListener('click', () => {
        fetch('/register')
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                popModal(res).then(() => {activateRegistration()});
            });
    });
}

if (el.login) {
    el.login.addEventListener('click', () => {
        fetch('/login')
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                popModal(res)
                    .then(() => {
                        const forgotPassword = el.forgotPassword();
                        forgotPassword.addEventListener('click', async () => {
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
                                            forgotPasswordForm.addEventListener('submit', (e) => {
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
                                            });
                                        });
                                });
                        });
                        window.activateLogin();
                    });
            });
    });
}

if (el.roll) {
    el.roll.addEventListener('click', () => {
        fetch(`/roll/${el.roll.value}`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                popModal(res)
                    .then(() => {
                        window.activateDice();
                    });
            });
    });
}

if (el.newCharacter) {
    el.newCharacter.addEventListener('click', () => {
        fetch('/new-character')
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.editCharacter) {
    el.editCharacter.addEventListener('click', () => {
        fetch(`/edit-character/${el.characterSelect.value}`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.deleteCharacter) {
    el.deleteCharacter.addEventListener('click', () => {
        fetch(`/delete-character/${el.characterSelect.value}`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.newStarship) {
    el.newStarship.addEventListener('click', () => {
        fetch('/new-starship')
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.editStarship) {
    el.editStarship.addEventListener('click', () => {
        fetch(`/edit-starship/${starshipId}`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.deleteStarship) {
    el.deleteStarship.addEventListener('click', () => {
        fetch(`/delete-starship/${starshipId}`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.newSystem) {
    el.newSystem.addEventListener('click', () => {
        fetch(`/starship/${starshipId}/division/${el.newSystem.value}/new-system`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
    });
}

if (el.editSystemButtons) {
    for (let i = 0; i < el.editSystemButtons.length; i++) {
        el.editSystemButtons[i].addEventListener('click', () => {
            let systemId = el.editSystemButtons[i].value;
            fetch(`/edit-system/${systemId}`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        });
    }
}

//manifest menu

if (el.crew) {
    el.crew.addEventListener('click', () => {
        fetch(`/starship/${starshipId}/crew-manifest`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
        el.manifestMenu.style.display = 'none';
    });
}

if (el.cargo) {
    el.cargo.addEventListener('click', () => {
        fetch(`/starship/${starshipId}/cargo-manifest`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => {
                popModal(res)
                    .then(() => window.activateCargo());
            });
        el.manifestMenu.style.display = 'none';
    });
}

if (el.jobs) {
    el.jobs.addEventListener('click', () => {
        if (true) {
            alert('This feature is not yet available');
            return;
        }
        fetch(`/starship/${starshipId}/jobs`)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
            .then((res) => popModal(res));
        el.manifestMenu.style.display = 'none';
    });
}





//welcome logo
if (el.welcomeLogo != null) {
    el.welcomeLogo.addEventListener('click', () => {
        fetch('/orientation')
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
