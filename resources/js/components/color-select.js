const hexCode = new RegExp('^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$');

export default function colorSelect(el, comp) {
    const modal = comp.modal(el, comp);
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
    
    el.selectPurple.onclick = () => {
        el.root.style.setProperty('--ui-color', '#ec42f5');
        fetch('/set-ui-color/purple/').then((res) => modal.flashModal(res));
    };
    
    el.selectRed.onclick = () => {
        el.root.style.setProperty('--ui-color', 'red');
        fetch('/set-ui-color/red/').then((res) => modal.flashModal(res));
    };

    el.selectPink.onclick = () => {
        el.root.style.setProperty('--ui-color', '#fc68a1');
        fetch('/set-ui-color/fc68a1/').then((res) => modal.flashModal(res));
    };
    
    el.selectBlue.onclick = () => {
        el.root.style.setProperty('--ui-color', 'blue');
        fetch('/set-ui-color/blue/').then((res) => modal.flashModal(res));
    };

    el.selectAqua.onclick = () => {
        el.root.style.setProperty('--ui-color', 'aqua');
        fetch('/set-ui-color/aqua/').then((res) => modal.flashModal(res));
    };
    el.selectGreen.onclick = () => {
        el.root.style.setProperty('--ui-color', '#4caf50');
        fetch('/set-ui-color/4caf50/').then((res) => modal.flashModal(res));
    };
    let handleColors = () => {
        let hexValue = selectCustom.value.replace('#', '');
        if (hexValue.length < 3) hexValue = '4caf50';
        if (hexCode.test(hexValue)) {
            el.root.style.setProperty('--ui-color', '#' + hexValue);
            fetch(`/set-ui-color/${hexValue}/`);
        }
    };
    el.selectCustom.onkeyup = () => { setTimeout(handleColors); };
    el.selectCustom.onchange = () => { setTimeout(handleColors); };
    el.selectCustom.onpaste = () => { setTimeout(handleColors); };
}
