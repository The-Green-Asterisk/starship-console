import * as el from './elements';
import { flashModal } from "./modal";

if (el.characterSelect != null) {
    el.characterSelect.addEventListener('change', () => {
        let characterId = el.characterSelect.value;
        window.location.href = `/character-select/${characterId}`;
    });
}
if (el.starshipSelect != null) {
    el.starshipSelect.addEventListener('change', () => {
        let starshipId = el.starshipSelect.value;
        document.querySelector('#dm-mode').checked
            ? window.location.href = `/dm-dashboard/${starshipId}`
            : window.location.href = `/starship-select/${starshipId}`;
    });
}

if (el.divisionCheckboxes != null) {
    for (let i = 0; i < el.divisionCheckboxes.length; i++) {
        el.divisionCheckboxes[i].querySelector('input').addEventListener('change', (e) => {
            e.stopImmediatePropagation();
            let characterId = el.divisionCheckboxes[i].querySelector('#division-character-id').value;
            let divisionId = el.divisionCheckboxes[i].querySelector('input').value;
            let url = `/character/${characterId}/division-select/${divisionId}`;
            fetch(url);
        });
    }
}

if (el.dmMode != null) {
    el.dmMode.addEventListener('change', () => {
        fetch('/dm-mode')
            .then((res) => {
                flashModal(res, '/dashboard');
            });
    });
}

if (el.characterImage != null) {
    el.characterImage.addEventListener('change', (e) => {
        document.characterImage.submit();
    })
}

if (el.emailInvite != null) {
    el.emailInvite.addEventListener('blur', (e) => {
        if (el.emailInvite.value.length > 0) {
            fetch(`/starship/add-user/${el.emailInvite.value}/${el.starshipSelect.value}`)
                .then(res => res.json()
                    .then(data => {
                        window.success(data.message);
                    })
                )
        }
    });
}
