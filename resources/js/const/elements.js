export default class El {
    body = document.querySelector('body');
    loader = document.querySelector('#loader');
    starshipId = document.querySelector('#starship-id')?.value;
    userId = document.querySelector('#user-id')?.value;
    crfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    reset = document.querySelector('#reset');
    manifestMenu = document.querySelector('#manifest-menu');
    manifestMenuButton = document.querySelector('#manifest');

    //color selector
    root = document.querySelector(':root');
    selectPurple = document.querySelector('#select-purple');
    selectRed = document.querySelector('#select-red');
    selectPink = document.querySelector('#select-pink');
    selectBlue = document.querySelector('#select-blue');
    selectAqua = document.querySelector('#select-aqua');
    selectGreen = document.querySelector('#select-green');
    selectCustom = document.querySelector('#select-custom');

    //dashboard
    characterSelect = document.querySelector('#character-select');
    starshipSelect = document.querySelector('#starship-select');
    divisionCheckboxes = document.getElementsByClassName('division-checkboxes');
    dmMode = document.querySelector('#dm-mode');
    characterImage = document.querySelector('#character-image');
    emailInvite = document.querySelector('#email-invite');

    //divisions
    quickFix = document.getElementsByClassName('quick-fix');
    focusedRepairs = document.getElementsByClassName('focused-repairs');
    deleteSystemButtons = document.getElementsByClassName('delete-system');

    //modals
    modal = () => { return document.querySelector('#modal'); }
    dialog = () => { return document.querySelector('#modal-dialog'); }
    closeButton = () => { return document.querySelector('#close-button'); }
    register = document.querySelector('#register');
    login = document.querySelector('#login');
    forgotPassword = () => { return document.querySelector('#forgot-password'); }
    forgotPasswordForm = () => { return document.querySelector('#forgot-password-form'); }
    forgotPasswordEmail = () => { return document.querySelector('#email').value; }
    roll = document.querySelector('#roll');
    newCharacter = document.querySelector('#new-character');
    editCharacter = document.querySelector('#edit-character');
    deleteCharacter = document.querySelector('#delete-character');
    newStarship = document.querySelector('#new-starship');
    editStarship = document.querySelector('#edit-starship');
    deleteStarship = document.querySelector('#delete-starship');
    newSystem = document.querySelector('#new-system');
    editSystemButtons = document.getElementsByClassName('edit-system');
    welcomeLogo = document.querySelector('#welcome-logo');

    //manifest modals
    crew = document.querySelector('#crew');
    cargo = document.querySelector('#cargo');
    jobs = document.querySelector('#jobs');

    //notifications
    notifButton = document.querySelector('#notif-button');
    indicator = document.querySelector('#indicator');
}

export const body = document.getElementById('body');
export const loader = document.getElementById('loader');
export const starshipId = document.getElementById('starship-id');
export const userId = document.getElementById('user-id');

export const reset = document.getElementById('reset');
export const manifestMenu = document.getElementById('manifest-menu');
export const manifestMenuButton = document.getElementById('manifest');

//color selector
export const root = document.querySelector(':root');
export const selectPurple = document.querySelector('#select-purple');
export const selectRed = document.querySelector('#select-red');
export const selectPink = document.querySelector('#select-pink');
export const selectBlue = document.querySelector('#select-blue');
export const selectAqua = document.querySelector('#select-aqua');
export const selectGreen = document.querySelector('#select-green');
export const selectCustom = document.querySelector('#select-custom');

//dashboard
export const characterSelect = document.getElementById('character-select');
export const starshipSelect = document.getElementById('starship-select');
export const divisionCheckboxes = document.getElementsByClassName('division-checkboxes');
export const dmMode = document.getElementById('dm-mode');
export const characterImage = document.getElementById('character-image');
export const emailInvite = document.getElementById('email-invite');

//divisions
export const quickFix = document.getElementsByClassName('quick-fix');
export const focusedRepairs = document.getElementsByClassName('focused-repairs');
export const deleteSystemButtons = document.getElementsByClassName('delete-system');

//modals
export const modal = () => { return document.getElementById('modal'); }
export const dialog = () => { return document.getElementById('modal-dialog'); }
export const closeButton = () => { return document.getElementById('close-button'); }
export const register = document.getElementById('register');
export const login = document.getElementById('login');
export const forgotPassword = () => { return document.getElementById('forgot-password'); }
export const forgotPasswordForm = () => { return document.getElementById('forgot-password-form'); }
export const forgotPasswordEmail = () => { return document.getElementById('email').value; }
export const roll = document.getElementById('roll');
export const newCharacter = document.getElementById('new-character');
export const editCharacter = document.getElementById('edit-character');
export const deleteCharacter = document.getElementById('delete-character');
export const newStarship = document.getElementById('new-starship');
export const editStarship = document.getElementById('edit-starship');
export const deleteStarship = document.getElementById('delete-starship');
export const newSystem = document.getElementById('new-system');
export const editSystemButtons = document.getElementsByClassName('edit-system');
export const welcomeLogo = document.getElementById('welcome-logo');
//manifest modals
export const crew = document.getElementById('crew');
export const cargo = document.getElementById('cargo');
export const jobs = document.getElementById('jobs');

//notifications
export const notifButton = document.getElementById('notif-button');
export const indicator = document.getElementById('indicator');
