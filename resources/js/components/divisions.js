import diceImp from "./modals/dice.js";
import modalImp from "./modal.js";

export default function (el) {
    const modal = modalImp(el);
    const dice = diceImp(el);

    if (el.quickFix != null) {
        for (let i = 0; i < el.quickFix.length; i++) {
            let button = el.quickFix[i]
            button.addEventListener('click', function () {
                let currentHp = parseInt(document.getElementById(`${button.value}detail`).innerText);
                if (currentHp > 0)
                    fetch(`/system/${button.value}/repair/${dice.d(4)}/d4`)
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
                let currentHp = parseInt(document.getElementById(`${button.value}detail`).innerText);
                if (currentHp > 0)
                    fetch(`/system/${button.value}/repair/${dice.d(8)}/d8`)
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
                fetch(`/delete-system/${systemId}`)
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

    function is_touch_enabled() {
        return ('ontouchstart' in window) ||
            (navigator.maxTouchPoints > 0) ||
            (navigator.msMaxTouchPoints > 0);
    }
    if (document.getElementById('touchscreen-info') != null) {
        if (is_touch_enabled()) {
            document.getElementById('touchscreen-info').style.display = 'block';
        } else {
            document.getElementById('touchscreen-info').style.display = 'none';
        }
    }
}