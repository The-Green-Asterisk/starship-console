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

notifButton ? notifButton.addEventListener('click', () => {
    let notifDrawer = document.getElementById('notif-drawer');
    if (notifDrawer == null) {
        fetchNotifications(false);
    } else {
        notifDrawer.remove();
    }
}): null;
body.addEventListener('click', (e) => {
    let notifDrawer = document.getElementById('notif-drawer');
    if (notifDrawer != null && !notifDrawer.contains(e.target)) notifDrawer.remove();
});

const fetchNotifications = (viewArchive) => {
    fetch(`/get-notifications/${viewArchive ? 1 : 0}`, getSecure)
        .then(async res => {
            res.text()
            .then(notifications => {
                let incoming = document.createElement('div')
                incoming.innerHTML = notifications;
                notifButton.after(incoming.firstChild);
                if (!viewArchive) {
                    document.getElementById('view-archive').addEventListener('click', getArchive);
                }
            });
        });
}

const getArchive = () => {
    document.getElementById('view-archive').removeEventListener('click', getArchive);
    document.getElementById('notif-drawer').remove();
    fetchNotifications(true);
}

window.read = async (id) => {
    let read;
    let archived;
    await fetch(`/read-notification/${id}`).then(res => res.json().then(r => {read = r.read, archived = r.archived}));
    let notification = document.getElementById(`notification-${id}`);
    let readButton = document.getElementById(`read-button-${id}`);
    notification.className = read ? archived ? 'read archived' : 'read' : archived ? 'archived notification' : 'notification';
    readButton.innerText = read ? 'Mark as UnRead' : 'Mark as Read';
    checkIndicator();
};
window.archive = async (id, viewArchive) => {
    let read;
    let archived;
    await fetch(`/archive-notification/${id}`).then(res => res.json().then(a => {archived = a.archived, read = a.read}));
    let notificationBox = document.getElementById(`notification-div-${id}`);
    let notification = document.getElementById(`notification-${id}`);
    let archiveButton = document.getElementById(`archive-button-${id}`);
    if (viewArchive) {
        notification.className = archived ? read ? 'read archived' : 'archived' : read ? 'read' : 'notification';
        archiveButton.innerText = archived ? 'UnArchive' : 'Archive';
    } else {
        notificationBox.style.display = 'none';
    }
    checkIndicator();
};

export { checkIndicator };
