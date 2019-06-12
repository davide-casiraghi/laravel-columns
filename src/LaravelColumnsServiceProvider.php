<?php

namespace DavideCasiraghi\LaravelColumns;

use Illuminate\Support\ServiceProvider;

class LaravelColumnsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-columns');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-columns');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if (! class_exists('CreateColumnsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_columns_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_columns_table.php'),
            ], 'migrations');
        }
        if (! class_exists('CreateColumnTranslationsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_column_translations_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_column_translations_table.php'),
            ], 'migrations');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-columns.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-columns'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-columns'),
            ], 'assets');*/

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-columns'),
            ], 'lang');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-columns');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-columns', function () {
            return new LaravelColumns;
        });
    }
}
