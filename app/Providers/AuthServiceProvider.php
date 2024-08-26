<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifica l\'indirizzo email')
                ->greeting('Benvenuto!')
                ->line('Per favore, clicca il pulsante qui sotto per verificare l\'email.')
                ->action('Verifica l\'indirizzo email', $url)
                ->line('Se non hai creato un account, non è richiesta nessuna azione.')
                ->salutation('Ti auguriamo un buon proseguimento, ' . env('APP_NAME'));
        });
    }
}
