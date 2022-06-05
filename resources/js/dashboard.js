import { getSecure } from "./app";

if (document.getElementById('character-select') != null){
    document.getElementById('character-select').addEventListener('change', () => {
        let characterId = document.getElementById('character-select').value;
        window.location.href = `/character-select/${characterId}`;
    });
}
if (document.getElementById('starship-select') != null){
    document.getElementById('starship-select').addEventListener('change', () => {
        let characterId = document.getElementById('starship-select').value;
        window.location.href = `/starship-select/${characterId}`;
    });
}

if (document.getElementsByClassName('division-checkboxes') != null){
    const checkboxes = document.getElementsByClassName('checkbox-label');
    for (let i = 0; i < checkboxes.length; i++){
        checkboxes[i].querySelector('input').addEventListener('change', () => {
            let characterId = document.getElementById('character-select').value;
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

if (document.querySelector('#character-image') != null) {
    document.querySelector('#character-image').addEventListener('change', (e) => {
        document.characterImage.submit();
    })
}
