<?php

namespace Nerdbrygg\SimpleSMS;

use Illuminate\Support\ServiceProvider;
use Nerdbrygg\SimpleSMS\View\Components\Form;
use Nerdbrygg\SimpleSMS\View\Components\Messages;

class SimpleSMSServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nerdbrygg');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nerdbrygg');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewComponentsAs('simplesms', [
            Form::class,
            Messages::class,
        ]);

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/simplesms.php', 'simplesms');

        // Register the service the package provides.
/*         $this->app->singleton('simplesms', function ($app) {
            return new SimpleSMS;
        }); */
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['simplesms'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/simplesms.php' => config_path('simplesms.php'),
        ], 'simplesms.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/nerdbrygg'),
        ], 'simplesms.views');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/nerdbrygg'),
        ], 'simplesms.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/nerdbrygg'),
        ], 'simplesms.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
