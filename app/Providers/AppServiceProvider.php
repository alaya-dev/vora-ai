<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Lang::handleMissingKeysUsing(function (string $key, array $replace, ?string $locale) {
            $currentLocale = $locale ?: app()->getLocale();
            $url = request() ? request()->fullUrl() : 'CLI/Tinker';

            \Illuminate\Support\Facades\Log::warning(sprintf(
                "Missing translation key: '%s' for locale: '%s' at URL: %s",
                $key,
                $currentLocale,
                $url
            ));

            return $key;
        });

        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            $count = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject(\Illuminate\Support\Facades\Lang::get('email_reset.subject'))
                ->view('emails.reset-password', [
                    'url' => $url,
                    'count' => $count,
                    'name' => $notifiable->name,
                ]);
        });
    }
}
