require('./bootstrap');
import * as el from './elements';
import { checkIndicator } from './notifications';

export const starshipId = (el.starshipId ? el.starshipId.value : null);
export const userId = (el.userId ? el.userId.value : null);
export const d = (n) => { return Math.floor(Math.random() * n) + 1 };
const { fetch: originalFetch } = window;
window.fetch = async (url, options = {}) => {
    el.loader.style.display = 'flex';
    options.headers
        ? options.headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        : options = { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } };
    const response = await originalFetch(url, options);
    el.loader.style.display = 'none';
    return response;
};


if (userId != null) {
    Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            const notif = document.createElement('div');
            notif.className = 'notif-drawer';
            notif.appendChild(document.createTextNode(notification.message))
            const anchor = document.createElement('a');
            anchor.href = notification.action;
            anchor.appendChild(notif);
            el.body.appendChild(anchor);
            setTimeout(() => {
                checkIndicator();
                notif.className = 'notif-drawer fadeout';
                setTimeout(() => {
                    el.body.removeChild(anchor);
                }, 1000)
            }, 3000)
        });
}

if (starshipId != null) {
    Echo.join(`presenceStarshipConsole.${starshipId}`)
        .listen('HpUpdate', (data) => {
            handleDamage(data.data);
        });
}

window.onload = () => {
    setTimeout(() => {
        el.loader.style.display = 'none';
    });
};

window.onbeforeunload = () => {
    el.body.className = 'fadeout';
};

var handleDamage = (e) => {
    if (document.getElementById("ship-" + e[e.length - 1].starshipId) != null &&
        document.getElementById("ship-" + e[e.length - 1].starshipId).value > e[e.length - 1].hp) {
        el.body.className = 'shake';
        setTimeout(() => {
            el.body.className = '';
        }, 1000);
        window.officerDamage(e[e.length - 1].officerDamage);
    };
    for (let i = 0; i < e.length; i++) {
        if (document.getElementById(e[i].systemId) != null)
            document.getElementById(e[i].systemId).value = e[i].hp;
        if (document.getElementById(e[i].systemId + 'detail') !== null) {
            document.getElementById(e[i].systemId + 'detail').innerText = e[i].current;
            document.getElementById(e[i].systemId + 'detail-percent').innerText = e[i].hp.toFixed(0) + '%';
        }
    }
    if (e.length > 1) {
        document.getElementById('ship-' + e[e.length - 1].starshipId).value = e[e.length - 1].hp;
        document.getElementById('ship-' + e[e.length - 1].starshipId + 'detail').innerText = e[e.length - 1].current;
        document.getElementById('ship-' + e[e.length - 1].starshipId + 'detail-percent').innerText = e[e.length - 1].hp.toFixed(0) + '%';
    }

    let hpbox = document.getElementsByClassName('hp' || 'hp danger');
    for (let i = 0; i < hpbox.length; i++)
        hpbox[i].querySelector('progress').value <= 25 ? hpbox[i].className = 'hp danger' : hpbox[i].className = 'hp';
};

if (el.reset != null) {
    el.reset.addEventListener('click', () => {
        fetch(`/starship/${starshipId}/reset-damage`, getSecure).then(endLoad);
    });
};
