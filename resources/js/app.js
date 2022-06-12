require('./bootstrap');

Echo.join(`presenceStarshipConsole.${document.getElementById('starship-id').value}`)
    .listen('HpUpdate', (data) => {
        handleDamage(data.data);
    });

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

window.onbeforeunload = () => {
    body.className = 'fadeout';
};

var handleDamage = (e) => {
    if (document.getElementById("ship-" + e[e.length - 1].starshipId) != null && document.getElementById("ship-" + e[e.length - 1].starshipId).value > e[e.length - 1].hp) {
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
    if (e.length>1) document.getElementById("ship-" + e[e.length - 1].starshipId).value = e[e.length - 1].hp;

    let  hpbox = document.getElementsByClassName('hp' || 'hp danger');
    for (let i = 0; i < hpbox.length; i++)
        hpbox[i].querySelector('progress').value <= 25 ? hpbox[i].className = 'hp danger' : hpbox[i].className = 'hp';
};


export { getSecure, postSecure, body, d };
