import * as el from './const/elements.js';
import { flashModal } from './modal.js';

const hexCode = new RegExp('^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$');


fetch('/get-ui-color/')
    .then(res => {
        if (res.ok) {
            res.text().then(hex => {
                if (hexCode.test(hex)) {
                    el.root.style.setProperty('--ui-color', `#${hex}`);
                } else if (hex == null) {
                    el.root.style.setProperty('--ui-color', '#4caf50');
                } else {
                    el.root.style.setProperty('--ui-color', hex);
                }
            });
        }
    });

if (el.selectPurple !== null) {
    el.selectPurple.addEventListener('click', () => {
        el.root.style.setProperty('--ui-color', '#ec42f5');
        fetch('/set-ui-color/purple/').then((res) => flashModal(res));
    });
}

if (el.selectRed !== null) {
    el.selectRed.addEventListener('click', () => {
        el.root.style.setProperty('--ui-color', 'red');
        fetch('/set-ui-color/red/').then((res) => flashModal(res));
    });
}
if (el.selectPink !== null) {
    el.selectPink.addEventListener('click', () => {
        el.root.style.setProperty('--ui-color', '#fc68a1');
        fetch('/set-ui-color/fc68a1/').then((res) => flashModal(res));
    });
}

if (el.selectBlue !== null) {
    el.selectBlue.addEventListener('click', () => {
        el.root.style.setProperty('--ui-color', 'blue');
        fetch('/set-ui-color/blue/').then((res) => flashModal(res));
    });
}

if (el.selectAqua !== null) {
    el.selectAqua.addEventListener('click', () => {
        el.root.style.setProperty('--ui-color', 'aqua');
        fetch('/set-ui-color/aqua/').then((res) => flashModal(res));
    });
}

if (el.selectGreen !== null) {
    el.selectGreen.addEventListener('click', () => {
        el.root.style.setProperty('--ui-color', '#4caf50');
        fetch('/set-ui-color/4caf50/').then((res) => flashModal(res));
    });
}

if (el.selectCustom !== null) {
    let handleColors = () => {
        let hexValue = selectCustom.value.replace('#', '');
        if (hexValue.length < 3) hexValue = '4caf50';
        if (hexCode.test(hexValue)) {
            el.root.style.setProperty('--ui-color', '#' + hexValue);
            fetch(`/set-ui-color/${hexValue}/`);
        }
    };
    el.selectCustom.addEventListener('keyup', () => { setTimeout(handleColors); });
    el.selectCustom.addEventListener('change', () => { setTimeout(handleColors); });
    el.selectCustom.addEventListener('paste', () => { setTimeout(handleColors); });
}
