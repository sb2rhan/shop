<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderApproved extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail(User $user)
    {
        return (new MailMessage)
            ->subject(__('Your order is approved'))
            ->greeting(__("Hello, {$user->name}!"))
            ->line(__('Thank you! Your order is approved. ') . __('Please, wait for delivery.'))
            ->action('See order', route('orders.show', $this->order));
    }
}
