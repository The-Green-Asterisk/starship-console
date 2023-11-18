import components from '../components';
import { flashModal } from "../components/modal";

export default function dashboard(el) {
    components.colorSelect(el);

    if (el.characterSelect) el.characterSelect.onchange = () => {
        let characterId = el.characterSelect.value;
        window.location.href = `/character-select/${characterId}`;
    };

    el.starshipSelect.onchange = () => {
        let starshipId = el.starshipSelect.value;
        document.querySelector('#dm-mode').checked
            ? window.location.href = `/dm-dashboard/${starshipId}`
            : window.location.href = `/starship-select/${starshipId}`;
    };

    [...el.divisionCheckboxes].forEach((checkbox) => {
        checkbox.querySelector('input').onchange = (e) => {
            e.stopImmediatePropagation();
            let characterId = checkbox.querySelector('#division-character-id').value;
            let divisionId = checkbox.querySelector('input').value;
            let url = `/character/${characterId}/division-select/${divisionId}`;
            fetch(url);
        };
    });
    
    el.dmMode.onchange = () => {
        fetch('/dm-mode')
            .then((res) => {
                flashModal(res, '/dashboard');
            });
    };

    if (el.characterImage) el.characterImage.onchange = (e) => {
        document.characterImage.submit();
    };
    
    el.emailInvite.onblur = (e) => {
        if (el.emailInvite.value.length > 0) {
            fetch(`/starship/add-user/${el.emailInvite.value}/${el.starshipSelect.value}`)
                .then(res => res.json()
                    .then(data => {
                        window.success(data.message);
                    })
                )
        }
    };
}
