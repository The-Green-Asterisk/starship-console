// const { body } = require('./app');

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

document.getElementById('register').addEventListener('click', () => {
    fetch('/register', this.getSecure)
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
        })
        .then(() => {require('/js/registration.js')});
    });
});

document.getElementById('login').addEventListener('click', () => {
    fetch('/login', this.getSecure)
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
        });
    });
});

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
        })
        .then(() => {require('/js/dice.js')});
    });
});


