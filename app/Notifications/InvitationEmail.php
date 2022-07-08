<?php

namespace App\Notifications;

use App\Models\Invite;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class InvitationEmail extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  Invite  $notifiable
     * @return array
     */
    public function via(Invite $notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(Invite $notifiable)
    {
        $registrationUrl = $this->registrationUrl($notifiable);

        return (new MailMessage)
            ->subject(Lang::get('Registration Notification'))
            ->greeting(Lang::get('Hi, :email.', ['email' => $notifiable->email]))
            ->line(Lang::get('You have been invited to join :appname', ['appname' => config('app.name')]))
            ->line(Lang::get('Please click the button below to register'))
            ->action(Lang::get('Register'), $registrationUrl)
            ->line(Lang::get("The invitation only valid until :count, please register before the invitation expired.", ['count' => $notifiable->expired_at->format('d F Y')]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(Invite $notifiable)
    {
        return [
            //
        ];
    }

    protected function registrationUrl(Invite $notifiable)
    {
        return URL::route('register', [
            'email' => $notifiable->getEmailForRegistration(),
            'token' => $notifiable->getTokenForRegistration(),
        ]);
    }
}
