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
