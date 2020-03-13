<?php


namespace Vladmeh\Socialite;


use Vladmeh\Socialite\Passport\PassportProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class SocialiteServiceProvider extends ServiceProvider
{
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
    }
}
