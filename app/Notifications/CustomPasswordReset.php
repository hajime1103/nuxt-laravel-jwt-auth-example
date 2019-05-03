<?php

namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomPasswordReset extends Notification
{
    use Queueable;
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('パスワードリセット') // 件名
            ->view('emails.resetpass') // メールテンプレートの指定
            ->action('リセットパスワード',
                config('frontend.url') . config('frontend.reset_pass_url') .
                config('frontend.parameter_queryUrl') . url('api/auth/password/reset', $this->token) . '&' . config('frontend.parameter_token') . $this->token
            );
    }
}
