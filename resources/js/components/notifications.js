export default function (el) {
    function checkIndicator() {
        if (el.indicator == null) return;
        fetch(`/get-notifications-raw`)
            .then(res => {
                res.json()
                    .then(notifications => {
                        let unread = false;
                        unread = notifications.some(n => n.read == false);
                        unread
                            ? el.indicator.style.display = 'block'
                            : el.indicator.style.display = 'none';
                    })
            });
        };
    checkIndicator();

    if (el.notifButton) el.notifButton.onclick = () => {
        if (!el.notifDrawer) {
            fetchNotifications(false);
        } else {
            el.notifDrawer.remove();
            el.notifDrawer = null;
        }
    };

    function fetchNotifications(viewArchive) {
        fetch(`/get-notifications/${viewArchive ? 1 : 0}`)
            .then(async res => {
                res.text()
                    .then(notifications => {
                        let incoming = document.createElement('div')
                        incoming.innerHTML = notifications;
                        el.notifButton.after(incoming.firstChild);
                        el.loadNotificationElements();
                        loadDrawer();
                        if (!viewArchive) {
                            el.viewArchiveButton.onclick = () => {
                                el.notifDrawer.remove();
                                fetchNotifications(true);
                            };
                        }
                    });
            });
    };

    async function read(id) {
        let read;
        let archived;
        await fetch(`/read-notification/${id}`).then(res => res.json().then(r => { read = r.read, archived = r.archived }));
        let notification = document.getElementById(`notification-${id}`);
        let readButton = document.getElementById(`read-button-${id}`);
        notification.className = read ? archived ? 'read archived' : 'read' : archived ? 'archived notification' : 'notification';
        readButton.innerText = read ? 'Mark as Unread' : 'Mark as Read';
        checkIndicator();
    };

    async function archive(id, viewArchive) {
        let read;
        let archived;
        const notificationBox = document.getElementById(`notification-div-${id}`);
        const notification = document.getElementById(`notification-${id}`);
        const archiveButton = document.getElementById(`archive-button-${id}`);

        await fetch(`/archive-notification/${id}`)
            .then(res => res.json()
                .then(a => {
                    archived = a.archived, 
                    read = a.read
                })
            );

        if (viewArchive) {
            notification.className = archived ? read ? 'read archived' : 'archived' : read ? 'read' : 'notification';
            archiveButton.innerText = archived ? 'Unarchive' : 'Archive';
        } else {
            notificationBox.style.display = 'none';
        }

        checkIndicator();
    };

    
    
    function loadDrawer() {
        if (el.readButtons) [...el.readButtons].forEach(button => {
            button.onclick = () => {
                const id = button.id.split('-')[2];
                read(id);
            };
        });

        if (el.archiveButtons) [...el.archiveButtons].forEach(button => {
            button.onclick = () => {
                const id = button.id.split('-')[2];
                archive(id, el.viewArchive);
            };
        });

        if (el.markAllAsRead) el.markAllAsRead.onclick = () => {
            fetch(`/get-notifications-raw`)
                .then(res => {
                    res.json()
                        .then(notifications => {
                            notifications.forEach(notification => {
                                if (!notification.read) read(notification.id);
                            });
                        });
                });
        };
    }

    loadDrawer();

    return {
        checkIndicator,
    };
}