require('./bootstrap');
import { rollValue } from './dice.js';

Echo.channel('starship-console')
    .listen('HpUpdate', (data) => {
        handleDamage(data.data);
    });

const htmlSecure = {method: 'GET', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}};
const fireButton = document.getElementById('fire-button');
const body = document.getElementById('body');

window.onbeforeunload = () => {
    body.className = 'fadeout';
};

var handleDamage = (e) => {
    body.className = 'shake';
    setTimeout(() => {
        body.className = '';
    }, 1000);
    for (let i = 0; i < e.length; i++)
    {
        document.getElementById(e[i].systemId).value = e[i].hp;
        if (document.getElementById(e[i].systemId + 'detail') !== null){
            document.getElementById(e[i].systemId + 'detail').innerText = e[i].current;
            document.getElementById(e[i].systemId + 'detail-percent').innerText = e[i].hp.toFixed(0) + '%';
        }
    }
    document.getElementById("ship-" + e[e.length - 1].systemId).value = e[e.length - 1].hp;

    let  hpbox = document.getElementsByClassName('hp' || 'hp danger');
    for (let i = 0; i < hpbox.length; i++)
        hpbox[i].querySelector('progress').value <= 25 ? hpbox[i].className = 'hp danger' : hpbox[i].className = 'hp';
};

var update = (damage) => {
    fetch(`/damage/1/${damage}`, htmlSecure)
    .then((res) => {
        if (!res.ok) {
            alert('Something went wrong');
            console.log(res.text());
        }
    })
};
if (fireButton !== null)
    fireButton.addEventListener('click', function(){update(rollValue);});
