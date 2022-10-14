import "./app";
import { getSecure } from "./app";

const notifButton = document.getElementById('notif-button');
const indicator = document.getElementById('indicator');
const checkIndicator = () => {
    if (indicator == null) return;
    fetch(`/get-notifications-raw`, getSecure)
        .then(res => {
            res.json()
            .then(notifications => {
                let unread = false;
                unread = notifications.some(n => n.read == false);
                unread
                    ? indicator.style.display = 'block'
                    : indicator.style.display = 'none';
            })
        });
};

notifButton.addEventListener('click', () => {
    let notifDrawer = document.getElementById('notif-drawer');
    if (notifDrawer == null) {
        fetchNotifications();
    } else {
        notifDrawer.remove();
    }
});
body.addEventListener('click', (e) => {
    let notifDrawer = document.getElementById('notif-drawer');
    if (notifDrawer != null && !notifDrawer.contains(e.target)) notifDrawer.remove();
});

const fetchNotifications = () => {
    fetch(`/get-notifications`, getSecure)
        .then(res => {
            res.text()
            .then(notifications => {
                let incoming = document.createElement('div')
                incoming.innerHTML = notifications;
                notifButton.after(incoming.firstChild);
            });
        });
}

window.read = (id) => {
    fetch(`/read-notification/${id}`);
    let notification = document.getElementById(`notification-${id}`);
    notification.className = 'notification not-bold';
    checkIndicator();
};
window.archive = (id) => {
    fetch(`/archive-notification/${id}`);
    let notification = document.getElementById(`notification-div-${id}`);
    notification.style.display = 'none';
    checkIndicator();
};

export { checkIndicator };
