import { getSecure } from "./app";

if (document.getElementById('character-select') != null){
    document.getElementById('character-select').addEventListener('change', () => {
        let characterId = document.getElementById('character-select').value;
        window.location.href = `/character-select/${characterId}`;
    });
}
if (document.getElementById('starship-select') != null){
    document.getElementById('starship-select').addEventListener('change', () => {
        let starshipId = document.getElementById('starship-select').value;
        document.querySelector('#dm-mode').checked == true
        ? window.location.href = `/dm-dashboard/${starshipId}`
        : window.location.href = `/starship-select/${starshipId}`;
    });
}

if (document.getElementsByClassName('division-checkboxes') != null){
    const checkboxes = document.getElementsByClassName('division-checkboxes');
    for (let i = 0; i < checkboxes.length; i++){
        checkboxes[i].querySelector('input').addEventListener('change', (e) => {
            e.stopImmediatePropagation();
            let characterId = checkboxes[i].querySelector('#division-character-id').value;
            let divisionId = checkboxes[i].querySelector('input').value;
            let url = `/character/${characterId}/division-select/${divisionId}`;
            fetch(url, getSecure)
            .then((res) => {
                res.text()
                .then((data) => {
                    let modal = document.createElement('div')
                    modal.innerHTML = data;
                    document.getElementById('body').appendChild(modal.firstChild);
                    setTimeout(() => {
                        document.getElementById('body').removeChild(document.getElementById('modal'));
                        location.reload();
                    }, 2000);
                });
            });
        });
    }
}

if (document.getElementById('dm-mode') != null){
    document.getElementById('dm-mode').addEventListener('change', () => {
        fetch('/dm-mode', getSecure)
        .then((res) => {
            res.text()
            .then((data) => {
                let modal = document.createElement('div')
                modal.innerHTML = data;
                document.getElementById('body').appendChild(modal.firstChild);
                setTimeout(() => {
                    document.getElementById('body').removeChild(document.getElementById('modal'));
                    window.location.href = '/dashboard';
                }, 2000);
            });
        });
    });
}

if (document.querySelector('#character-image') != null) {
    document.querySelector('#character-image').addEventListener('change', (e) => {
        document.characterImage.submit();
    })
}

if (document.getElementById('email-invite') != null){
    let emailInvite = document.getElementById('email-invite');
    emailInvite.addEventListener('blur', (e) => {
        if (emailInvite.value.length > 0){
            let starshipId = document.querySelector('#starship-select').value
            fetch(`/starship/add-user/${emailInvite.value}/${starshipId}`, getSecure)
                .then(res => res.json()
                    .then(data => {
                        window.success(data.message);
                    })
                )
        }
    });
}
