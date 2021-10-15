<?php


namespace Vladmeh\Socialite;


use Vladmeh\Socialite\Passport\PassportProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class SocialiteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/services.php',
            'socialite'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $socialite = $this->app->make(Factory::class);
        $socialite->extend('passport', function () use ($socialite) {
            $config = config('services.passport');
            return $socialite->buildProvider(PassportProvider::class, $config);
        });

        $this->registerPublishing();
    }

    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/services.php' => config_path('services.php'),
            ], 'socialite-passport-config');
        }
    }
}
