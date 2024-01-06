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
    loginForm = () => { return document.querySelector('#login-form'); }
    seePass = () => { return document.querySelector('#see-pass'); }
    registrationForm = () => { return document.querySelector('#registration-form'); }
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
    notifButton;
    indicator;
    notifDrawer;
    viewArchive;
    markAllAsRead;
    readButtons;
    archiveButtons;
    viewArchive;
    viewArchiveButton;
    loadNotificationElements() {
        this.notifButton = document.querySelector('#notif-button');
        this.indicator = document.querySelector('#indicator');
        this.notifDrawer = document.querySelector('#notif-drawer');
        this.viewArchive = document.querySelector('#view-archive');
        this.markAllAsRead = document.querySelector('#mark-all-as-read');
        this.readButtons = document.getElementsByClassName('read-button');
        this.archiveButtons = document.getElementsByClassName('archive-button');
        this.viewArchive = document.querySelector('#view-archive')?.value;
        this.viewArchiveButton = document.querySelector('#view-archive-button');
    }
    
    constructor() {
        this.loadNotificationElements();

        this.body.onclick = (e) => {
            if (!!this.notifDrawer && !this.notifDrawer.contains(e.target)) {
                this.notifDrawer.remove();
                this.notifDrawer = null;
            }
        };

        if (this.reset != null) {
            this.reset.onclick = () => {
                fetch(`/starship/${el.starshipId}/reset-damage`);
            };
        };
    
        if (this.manifestMenuButton) {
            this.manifestMenuButton.onclick = () => {
                this.manifestMenu.style.display === 'block'
                    ? this.manifestMenu.style.display = 'none'
                    : this.manifestMenu.style.display = 'block';
            };
            this.manifestMenu.onmouseleave = () => {
                this.manifestMenu.style.display = 'none';
            };
        }
    }
}