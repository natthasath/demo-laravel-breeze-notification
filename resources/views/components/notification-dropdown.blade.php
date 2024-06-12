<div class="relative">
    <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
        <svg class="h-6 w-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.121V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 7 7.388 7 9v5.121a2.032 2.032 0 01-.595 1.474L5 17h5m2 4v1a2 2 0 11-4 0v-1m0 0h4"></path>
        </svg>
    </button>

    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800">
        <div class="py-2">
            @forelse (auth()->user()->notifications as $notification)
                <a href="#" class="block px-4 py-2 text-sm text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    {{ $notification->data['message'] ?? 'You have a new notification' }}
                </a>
            @empty
                <p class="block px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                    No notifications
                </p>
            @endforelse
        </div>
    </div>
</div>
