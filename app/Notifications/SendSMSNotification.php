<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use NotificationChannels\AwsSns\SnsChannel;
use NotificationChannels\AwsSns\SnsMessage;

class SendSMSNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param    mixed  $notifiable
     *
     * @return  array
     */
    public function via($notifiable): array
    {
        return [SnsChannel::class];
    }

    /**
     * @param  $notifiable
     *
     * @return  SnsMessage
     */
    public function toSns($notifiable): SnsMessage
    {
        $code = $notifiable->reset_password_code;
        $link = URL::to('reset-password/'.$code);
        
        // OR explicitly return a SnsMessage object passing the message body:
        return new SnsMessage(html_entity_decode(view('sms.password_reset', compact('link'))));
    }
}
