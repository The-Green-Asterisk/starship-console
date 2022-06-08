import { getSecure } from './app.js';

const root = document.querySelector(':root');
const selectPurple = document.querySelector('#select-purple');
const selectRed = document.querySelector('#select-red');
const selectBlue = document.querySelector('#select-blue');
const selectAqua = document.querySelector('#select-aqua');
const selectGreen = document.querySelector('#select-green');
const selectCustom = document.querySelector('#select-custom');
const hexCode = new RegExp('^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$');


fetch('/get-ui-color/', getSecure)
    .then(res => {
        if (res.ok) {
            res.text().then(hex => {
                if (hexCode.test(hex)) {
                    root.style.setProperty('--ui-color', `#${hex}`);
                }else if (hex == null) {
                    root.style.setProperty('--ui-color', '#4caf50');
                }else{
                    root.style.setProperty('--ui-color', hex);
                }
            });
        }
    });

if (selectPurple !== null) {
    selectPurple.addEventListener('click', () => {
        root.style.setProperty('--ui-color', 'purple');
        fetch('/set-ui-color/purple/', getSecure);
    });
}

if (selectRed !== null) {
    selectRed.addEventListener('click', () => {
        root.style.setProperty('--ui-color', 'red');
        fetch('/set-ui-color/red/', getSecure);
    });
}

if (selectBlue !== null) {
    selectBlue.addEventListener('click', () => {
        root.style.setProperty('--ui-color', 'blue');
        fetch('/set-ui-color/blue/', getSecure);
    });
}

if (selectAqua !== null) {
    selectAqua.addEventListener('click', () => {
        root.style.setProperty('--ui-color', 'aqua');
        fetch('/set-ui-color/aqua/', getSecure);
    });
}

if (selectGreen !== null) {
    selectGreen.addEventListener('click', () => {
        root.style.setProperty('--ui-color', '#4caf50');
        fetch('/set-ui-color/4caf50/', getSecure);
    });
}

if (selectCustom !== null) {
    selectCustom.addEventListener('change', () => {
        let hexValue = selectCustom.value.replace('#', '');
        if (hexValue.length < 3) hexValue = '4caf50';
        root.style.setProperty('--ui-color', '#' + hexValue);
        fetch(`/set-ui-color/${hexValue}/`, getSecure);
    });
}
