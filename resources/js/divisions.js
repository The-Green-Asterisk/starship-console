import { getSecure, d } from "./app";
import { clickOutside, closeModal } from "./modal";

const quickFix = document.getElementsByClassName('quick-fix');
const focusedRepairs = document.getElementsByClassName('focused-repairs');
const deleteSystemButtons = document.getElementsByClassName('delete-system');

if (quickFix != null) {
    for (let i = 0; i < quickFix.length; i++) {
        let button = quickFix[i]
        button.addEventListener('click', function () {
            fetch(`/system/${button.value}/repair/${d(4)}/d4`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            });
        });
    }
}
if (focusedRepairs != null) {
    for (let i = 0; i < focusedRepairs.length; i++) {
        let button = focusedRepairs[i]
        button.addEventListener('click', function () {
            fetch(`/system/${button.value}/repair/${d(8)}/d8`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            });
        });
    }
}

if (deleteSystemButtons != null) {
    for (const dButton of deleteSystemButtons) {
        dButton.addEventListener('click', () => {
            let systemId = dButton.value;
            fetch(`/delete-system/${systemId}`, getSecure)
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
