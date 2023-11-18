export default function starship(el) {
    const starshipId = (el.starshipId ? el.starshipId.value : null);
    const userId = (el.userId ? el.userId.value : null);


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
        el.reset.onclick = () => {
            fetch(`/starship/${starshipId}/reset-damage`);
        };
    };

    if (el.manifestMenuButton) {
        el.manifestMenuButton.onclick = () => {
            el.manifestMenu.style.display === 'block'
                ? el.manifestMenu.style.display = 'none'
                : el.manifestMenu.style.display = 'block';
        };
        el.manifestMenu.onmouseleave = () => {
            el.manifestMenu.style.display = 'none';
        };
    }

    window.limit255 = (e) => {
        if (e.innerText.length > 255) {
            e.innerText = e.innerText.substring(0, 255);
            var range = document.createRange();
            var sel = window.getSelection();
            range.setStart(e.childNodes[0], 255);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }

    window.limitLong = (e) => {
        if (e.innerText.length > 65535) {
            e.innerText = e.innerText.substring(0, 65535);
            var range = document.createRange();
            var sel = window.getSelection();
            range.setStart(e.childNodes[0], 65535);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }

    return {
        handleDamage,
        limit255,
        limitLong
    }
}