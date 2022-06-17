import { getSecure, starshipId } from "./app";

var closeModal = () => {
    let modal = document.getElementById('modal');
    if (modal != null){
        modal.className = 'modal fadeout';
        setTimeout(() => {
            modal.parentElement.removeChild(modal);
            document.removeEventListener('click', clickOutside);
        }, 350);
    }
};
var clickOutside = (ev) => {
    ev.stopImmediatePropagation();
    let dialog = document.getElementById('modal-dialog');
    if (dialog != null && !dialog.contains(ev.target)){
        closeModal();
    }
};
window.success = (message) => {
        fetch(`/success/${message}`, getSecure)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            res.text()
            .then((data) => {
                let incomingModal = document.createElement('div');
                incomingModal.innerHTML = data;
                body.appendChild(incomingModal.firstChild);
                setTimeout(() => {
                    closeModal();
                }, 3000);
            });
        });
    };

window.officerDamage = (div) => {
    let incomingModal = document.createElement('div');
    incomingModal.innerHTML = div;
    body.appendChild(incomingModal.firstChild);
    document.addEventListener('click', (e) => {clickOutside(e)});
    document.getElementById('close-button').addEventListener('click', () => {closeModal()});
}

if (document.getElementById('register') != null){
    document.getElementById('register').addEventListener('click', () => {
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                window.activateRegistration();
            })
        });
    });
}

if (document.getElementById('login') != null){
    document.getElementById('login').addEventListener('click', () => {
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
                window.activateLogin();
            });
        });
    });
}

if (document.getElementById('roll') != null){
    document.getElementById('roll').addEventListener('click', () => {
        let rollValue = document.getElementById('roll').value;
        fetch(`/roll/${rollValue}`, getSecure)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            res.text()
            .then((data) => {
                let incomingModal = document.createElement('div');
                incomingModal.innerHTML = data;
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {
                    rollValue = 0;
                    closeModal();
                });
                window.activateDice();
            })
        });
    });
}

if (document.getElementById('new-character') != null){
    document.getElementById('new-character').addEventListener('click', () => {
        fetch('/new-character', getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementById('edit-character') != null){
    document.getElementById('edit-character').addEventListener('click', () => {
        let characterId = document.getElementById('character-select').value;
        fetch(`/edit-character/${characterId}`, getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementById('delete-character') != null){
    document.getElementById('delete-character').addEventListener('click', () => {
        let characterId = document.getElementById('character-select').value;
        fetch(`/delete-character/${characterId}`, getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementById('new-starship') != null){
    document.getElementById('new-starship').addEventListener('click', () => {
        fetch('/new-starship', getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementById('edit-starship') != null){
    document.getElementById('edit-starship').addEventListener('click', () => {
        fetch(`/edit-starship/${starshipId}`, getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementById('delete-starship') != null){
    document.getElementById('delete-starship').addEventListener('click', () => {
        fetch(`/delete-starship/${starshipId}`, getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementById('crew') != null){
    document.getElementById('crew').addEventListener('click', () => {
        fetch(`/starship/${starshipId}/crew-manifest`, getSecure)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            res.text()
            .then((data) => {
                let incomingModal = document.createElement('div');
                incomingModal.innerHTML = data;
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            })
        });
    });
}

if (document.getElementById('new-system') != null){
    document.getElementById('new-system').addEventListener('click', () => {
        let divisionId = document.getElementById('new-system').value;
        fetch(`/starship/${starshipId}/division/${divisionId}/new-system`, getSecure)
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
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
                document.getElementById('close-button').addEventListener('click', () => {closeModal()});
            });
        });
    });
}

if (document.getElementsByClassName('edit-system') != null){
    let editSystemButtons = document.getElementsByClassName('edit-system');
    for (let i = 0; i < editSystemButtons.length; i++){
        editSystemButtons[i].addEventListener('click', () => {
            let systemId = editSystemButtons[i].value;
            fetch(`/edit-system/${systemId}`, getSecure)
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
                    body.appendChild(incomingModal.firstChild);
                    document.addEventListener('click', (e) => {clickOutside(e)});
                    document.getElementById('close-button').addEventListener('click', () => {closeModal()});
                });
            });
        });
    }
}

if (document.getElementById('welcome-logo') != null){
    document.getElementById('welcome-logo').addEventListener('click', () => {
        fetch('/orientation', getSecure)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            res.text()
            .then((data) => {
                let incomingModal = document.createElement('div');
                incomingModal.innerHTML = data;
                body.appendChild(incomingModal.firstChild);
                document.addEventListener('click', (e) => {clickOutside(e)});
            });
        });
    });
}

export {
    clickOutside,
    closeModal,
};
