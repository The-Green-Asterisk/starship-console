import _ from 'lodash';
window._ = _;
import axios from 'axios';
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

import './const/elements.js';
import './dashboard.js';
import './modal.js';
import './modals/dice.js';
import './modals/registration.js';
import './modals/login.js';
import './modals/cargo-manifest.js';
import './divisions.js';
import './color-select.js';
import './notifications.js';
