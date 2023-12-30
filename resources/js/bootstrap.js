import axios from 'axios';
import _ from 'lodash';
window._ = _;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// import './components/color-select.js';
// import './components/divisions.js';
// import './components/modal.js';
// import './components/notifications.js';
// import './const/elements.js';
// import './modals/cargo-manifest.js';
// import './modals/dice.js';
// import './modals/login.js';
// import './modals/registration.js';

