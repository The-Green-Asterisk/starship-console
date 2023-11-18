window._ = require('lodash');                                           //////
window.axios = require('axios');                                            //
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';//
//
import Echo from 'laravel-echo'; //
//
window.Pusher = require('pusher-js');                                       //  Don't touch any of these
//
window.Echo = new Echo({                                                    //
    broadcaster: 'pusher',                                                  //
    key: process.env.MIX_PUSHER_APP_KEY,                                    //
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,                            //
    forceTLS: true                                                          //
});                                                                     //////

require('./const/elements.js');
require('./dashboard.js');
require('./modal.js');
require('./modals/dice.js');
require('./modals/registration.js');
require('./modals/login.js');
require('./modals/cargo-manifest.js');
require('./divisions.js');
require('./color-select.js');
require('./notifications.js');
