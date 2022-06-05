import { getSecure, d } from "./app";

const quickFix = document.getElementsByClassName('quick-fix');
const focusedRepairs = document.getElementsByClassName('focused-repairs');

if (quickFix != null) {
    for (let i = 0; i < quickFix.length; i++) {
        let button = quickFix[i]
        button.addEventListener('click', function () {
            fetch(`/system/${button.value}/repair/${d(4)}`, getSecure)
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
            fetch(`/system/${button.value}/repair/${d(8)}`, getSecure)
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            });
        });
    }
}
