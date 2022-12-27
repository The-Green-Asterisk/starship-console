import * as el from './elements.js';
import { getSecure, d } from "./app";
import { clickOutside, closeModal } from "./modal";

if (el.quickFix != null) {
    for (let i = 0; i < el.quickFix.length; i++) {
        let button = el.quickFix[i]
        button.addEventListener('click', function () {
            fetch(`/system/${button.value}/repair/${d(4)}/d4`, getSecure)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                });
        });
    }
}

if (el.focusedRepairs != null) {
    for (let i = 0; i < el.focusedRepairs.length; i++) {
        let button = el.focusedRepairs[i]
        button.addEventListener('click', function () {
            fetch(`/system/${button.value}/repair/${d(8)}/d8`, getSecure)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                });
        });
    }
}

if (el.deleteSystemButtons != null) {
    for (const dButton of el.deleteSystemButtons) {
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
                            document.addEventListener('click', (e) => { clickOutside(e) });
                            el.closeButton.addEventListener('click', () => { closeModal() });
                        });
                });
        });
    }
}
