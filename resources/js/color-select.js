import { getSecure } from './app.js';

const root = document.querySelector(':root');
const selectPurple = document.querySelector('#select-purple');
const selectRed = document.querySelector('#select-red');
const selectPink = document.querySelector('#select-pink');
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
        root.style.setProperty('--ui-color', '#ec42f5');
        fetch('/set-ui-color/purple/', getSecure);
    });
}

if (selectRed !== null) {
    selectRed.addEventListener('click', () => {
        root.style.setProperty('--ui-color', 'red');
        fetch('/set-ui-color/red/', getSecure);
    });
}
if (selectPink !== null) {
    selectPink.addEventListener('click', () => {
        root.style.setProperty('--ui-color', '#fc68a1');
        fetch('/set-ui-color/fc68a1/', getSecure);
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
    let handleColors = () => {
        let hexValue = selectCustom.value.replace('#', '');
        if (hexValue.length < 3) hexValue = '4caf50';
        if (hexCode.test(hexValue)) {
            root.style.setProperty('--ui-color', '#' + hexValue);
            fetch(`/set-ui-color/${hexValue}/`, getSecure);
        }
    };
    selectCustom.addEventListener('keyup', ()=> {setTimeout(handleColors);});
    selectCustom.addEventListener('change', ()=> {setTimeout(handleColors);});
    selectCustom.addEventListener('paste', ()=> {setTimeout(handleColors);});
}
