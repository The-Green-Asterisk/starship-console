export default function starship(el, comp) {
    const modal = comp.modal(el, comp);

    var handleDamage = (e) => {
        if (document.getElementById("ship-" + e[e.length - 1].starshipId) != null &&
            document.getElementById("ship-" + e[e.length - 1].starshipId).value > e[e.length - 1].hp) {
            el.body.className = 'shake';
            setTimeout(() => {
                el.body.className = '';
            }, 1000);
            modal.popModal(e[e.length - 1].officerDamage);
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

    return {
        handleDamage
    }
}