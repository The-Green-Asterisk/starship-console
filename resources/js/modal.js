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
        fetch(`/success/${message}`, this.getSecure)
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

if (document.getElementById('register') != null){
    document.getElementById('register').addEventListener('click', () => {
        fetch('/register', this.getSecure)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            this.hadFocus = document.activeElement;
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
        fetch('/login', this.getSecure)
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

if (document.getElementById('roll') != null){
    document.getElementById('roll').addEventListener('click', () => {
        let rollValue = document.getElementById('roll').value;
        fetch(`/roll/${rollValue}`, this.getSecure)
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
        fetch('/new-character', this.getSecure)
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
        fetch('/new-starship', this.getSecure)
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
