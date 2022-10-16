require('./bootstrap');
import { checkIndicator } from './notifications';

window.checkIndicator = () => { checkIndicator() };
const starshipId = (document.getElementById('starship-id') ? document.getElementById('starship-id').value : null);
const userId = (document.getElementById('user-id') ? document.getElementById('user-id').value : null);
const d = (n) => {return Math.floor(Math.random() * n) + 1};
const body = document.getElementById('body');
const getSecure = {
    method: 'GET',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
};
const postSecure = {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
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
            body.appendChild(anchor);
            setTimeout(() => {
                window.checkIndicator();
                notif.className = 'notif-drawer fadeout';
                setTimeout(() => {
                    body.removeChild(anchor);
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

window.onbeforeunload = () => {
    body.className = 'fadeout';
};

var handleDamage = (e) => {
    if (document.getElementById("ship-" + e[e.length - 1].starshipId) != null &&
        document.getElementById("ship-" + e[e.length - 1].starshipId).value > e[e.length - 1].hp) {
        body.className = 'shake';
        setTimeout(() => {
            body.className = '';
        }, 1000);
        window.officerDamage(e[e.length - 1].officerDamage);
    };
    for (let i = 0; i < e.length; i++)
    {
        if (document.getElementById(e[i].systemId) != null)
            document.getElementById(e[i].systemId).value = e[i].hp;
        if (document.getElementById(e[i].systemId + 'detail') !== null){
            document.getElementById(e[i].systemId + 'detail').innerText = e[i].current;
            document.getElementById(e[i].systemId + 'detail-percent').innerText = e[i].hp.toFixed(0) + '%';
        }
    }
    if (e.length > 1) {
        document.getElementById('ship-' + e[e.length - 1].starshipId).value = e[e.length - 1].hp;
        document.getElementById('ship-' + e[e.length - 1].starshipId + 'detail').innerText = e[e.length - 1].current;
        document.getElementById('ship-' + e[e.length - 1].starshipId + 'detail-percent').innerText = e[e.length - 1].hp.toFixed(0) + '%';
    }

    let  hpbox = document.getElementsByClassName('hp' || 'hp danger');
    for (let i = 0; i < hpbox.length; i++)
        hpbox[i].querySelector('progress').value <= 25 ? hpbox[i].className = 'hp danger' : hpbox[i].className = 'hp';
};

if (document.getElementById('reset') != null) {
    document.getElementById('reset').addEventListener('click', () => {
        fetch(`/starship/${starshipId}/reset-damage`, getSecure)
        fetch(`/notify`);
    });
};

export { getSecure, postSecure, body, d, starshipId };
