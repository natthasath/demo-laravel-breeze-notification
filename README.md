# 🎉 DEMO Laravel Breeze Notification

Laravel Notification Channels are used to send notifications via various services such as SMS, Slack, and email. These channels extend Laravel's notification system, allowing developers to easily integrate and manage multiple communication platforms within their applications.

![version](https://img.shields.io/badge/version-1.0-blue)
![rating](https://img.shields.io/badge/rating-★★★★★-yellow)
![uptime](https://img.shields.io/badge/uptime-100%25-brightgreen)

### 🚀 Setup

- Create Project

```shell
composer create-project laravel/laravel example-app
```

- Install Package

```shell
composer require laravel/breeze --dev
composer require laravel-notification-channels/webpush
```

- Add Trait to `User` Model

```
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Model
{
    use HasPushSubscriptions;
}
```

- Publish Migrations

```
php artisan vendor:publish --provider="NotificationChannels\WebPush\WebPushServiceProvider" --tag="migrations"
```

- Publish Configuration

```
php artisan vendor:publish --provider="NotificationChannels\WebPush\WebPushServiceProvider" --tag="config"
```

- Generate VAPID Keys

```
php artisan webpush:vapid
```

- Create Notification `PushNotification`

```
php artisan make:notification PushNotification
```

- Update File `PushNotification`

```
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Approved!')
            ->icon('/approved-icon.png')
            ->body('Your account was approved!')
            ->action('View account', 'view_account')
            ->options(['TTL' => 1000]);
            // ->data(['id' => $notification->id])
            // ->badge()
            // ->dir()
            // ->image()
            // ->lang()
            // ->renotify()
            // ->requireInteraction()
            // ->tag()
            // ->vibrate()
    }
}
```

- Create Controller `PushSubscriptionController`

```
php artisan make:controller PushSubscriptionController
```

- Migrate

```
php artisan migrate
npm install
npm run dev
```

- aaa

````
php artisan make:notification NewsNotification
php artisan make:migration create_notifications_table
php artisan migrate
```

### 🏆 Run

- [http://localhost:8000/](http://localhost:8000/) username : `admin` password : `admin`

```shell
php artisan serve
```
