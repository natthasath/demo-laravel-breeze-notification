const subscribeButton = document.getElementById('subscribe');
const notifyButton = document.getElementById('notify');

subscribeButton.addEventListener('click', async () => {
    const permission = await Notification.requestPermission();
    if (permission === 'granted') {
        const registration = await navigator.serviceWorker.register('/service-worker.js');
        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: "{{ config('webpush.vapid.public_key') }}"
        });
        await fetch('/save-subscription', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify(subscription)
        });
    }
});

notifyButton.addEventListener('click', () => {
    fetch('/send-notification', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
});
