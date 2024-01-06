import './bootstrap';

import components from './components';
import constants from './const';
import pages from './pages';

import { initLoader } from './services/request';

const elements = new constants.El();
initLoader(elements);

switch (constants.PathNames.basePath()) {
    case constants.PathNames.HOME:
        pages.home(elements, components);
        break;
    case constants.PathNames.DASHBOARD:
    case constants.PathNames.DM_DASHBOARD:
        pages.dashboard(elements, components);
        break;
    case constants.PathNames.STARSHIP:
        pages.starship(elements, components);
        switch (constants.PathNames.subdirectories()[1]) {
            case constants.PathNames.DIVISION:
                pages.divisions(elements, components)
                break;
            default:
                break;
            };
    default:
        break;
}

const notifications = components.notifications(elements);
if (elements.userId != null) {
    const userId = elements.userId;
    Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            const notif = document.createElement('div');
            notif.className = 'notif-drawer';
            notif.appendChild(document.createTextNode(notification.message))
            const anchor = document.createElement('a');
            anchor.href = notification.action;
            anchor.appendChild(notif);
            elements.body.appendChild(anchor);
            setTimeout(() => {
                notifications.checkIndicator();
                notif.className = 'notif-drawer fadeout';
                setTimeout(() => {
                    elements.body.removeChild(anchor);
                }, 1000)
            }, 3000)
        });
}

if (elements.starshipId != null) {
    Echo.join(`presenceStarshipConsole.${elements.starshipId}`)
        .listen('HpUpdate', (res) => {
            pages.starship(elements, components).handleDamage(res.data);
        });
}

window.onload = () => {
    setTimeout(() => {
        elements.loader.style.display = 'none';
    });
};

window.onbeforeunload = () => {
    elements.body.className = 'fadeout';
};

window.success = (message) => {
    fetch(`/success/${message}`)
        .catch((err) => {
            console.log(err);
            alert('Something went wrong');
        })
        .then((res) => {
            flashModal(res);
        });
};