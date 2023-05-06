export const el = {
    body: document.getElementById('body'),
    loader: document.getElementById('loader'),
    starshipId: document.getElementById('starship-id'),
    userId: document.getElementById('user-id'),

    reset: document.getElementById('reset'),
    manifestMenu: document.getElementById('manifest-menu'),
    manifestMenuButton: document.getElementById('manifest'),

    //color selector
    root: document.querySelector(':root'),
    selectPurple: document.querySelector('#select-purple'),
    selectRed: document.querySelector('#select-red'),
    selectPink: document.querySelector('#select-pink'),
    selectBlue: document.querySelector('#select-blue'),
    selectAqua: document.querySelector('#select-aqua'),
    selectGreen: document.querySelector('#select-green'),
    selectCustom: document.querySelector('#select-custom'),

    //dashboard
    characterSelect: document.getElementById('character-select'),
    starshipSelect: document.getElementById('starship-select'),
    divisionCheckboxes: document.getElementsByClassName('division-checkboxes'),
    dmMode: document.getElementById('dm-mode'),
    characterImage: document.getElementById('character-image'),
    emailInvite: document.getElementById('email-invite'),

    //divisions
    quickFix: document.getElementsByClassName('quick-fix'),
    focusedRepairs: document.getElementsByClassName('focused-repairs'),
    deleteSystemButtons: document.getElementsByClassName('delete-system'),

    //modals
    modal: () => { return document.getElementById('modal'); },
    dialog: () => { return document.getElementById('modal-dialog'); },
    closeButton: () => { return document.getElementById('close-button'); },
    register: document.getElementById('register'),
    login: document.getElementById('login'),
    forgotPassword: () => { return document.getElementById('forgot-password'); },
    forgotPasswordForm: () => { return document.getElementById('forgot-password-form'); },
    forgotPasswordEmail: () => { return document.getElementById('email').value; },
    roll: document.getElementById('roll'),
    newCharacter: document.getElementById('new-character'),
    editCharacter: document.getElementById('edit-character'),
    deleteCharacter: document.getElementById('delete-character'),
    newStarship: document.getElementById('new-starship'),
    editStarship: document.getElementById('edit-starship'),
    deleteStarship: document.getElementById('delete-starship'),
    newSystem: document.getElementById('new-system'),
    editSystemButtons: document.getElementsByClassName('edit-system'),
    welcomeLogo: document.getElementById('welcome-logo'),

    //manifest modals
    crew: document.getElementById('crew'),
    cargo: document.getElementById('cargo'),
    jobs: document.getElementById('jobs'),

    //notifications
    notifButton: document.getElementById('notif-button'),
    indicator: document.getElementById('indicator')
}
