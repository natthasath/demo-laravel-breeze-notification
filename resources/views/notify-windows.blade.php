<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notify Windows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="button-blue" id="subscribe">Subscribe for Notifications</button>
                    <button class="button-dark" id="notify">Send Notification</button>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>
</x-app-layout>
