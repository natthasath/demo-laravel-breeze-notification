self.addEventListener('push', function(event) {
    const data = event.data.json();

    const options = {
        body: data.body,
        icon: data.icon,
        badge: data.badge,
        actions: data.actions
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    if (event.action === 'view_app') {
        clients.openWindow('/');
    }
});
