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
    const checkboxes = document.getElementsByClassName('div-check');
    for (let i = 0; i < checkboxes.length; i++){
        checkboxes[i].addEventListener('change', () => {
            let characterId = document.getElementById('character-select').value;
            let divisionId = checkboxes[i].value;
            let checked = checkboxes[i].checked;
            let url = `/character/${characterId}/division-select/${divisionId}/${checked}`;
            fetch(url, this.getSecure)
            .then((res) => {
                res.text()
                .then((data) => {
                    let modal = document.createElement('div')
                    modal.innerHTML = data;
                    document.getElementById('body').appendChild(modal.firstChild);
                    setTimeout(() => {
                        document.getElementById('body').removeChild(document.getElementById('modal'));
                    }, 2000);
                });
            });
        });
    }
}
