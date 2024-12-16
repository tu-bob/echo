<?php

namespace Modules\Counters\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Database\Eloquent\Factory;

class CountersServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Counters', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Counters', 'Config/config.php') => config_path('counters.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Counters', 'Config/config.php'), 'counters'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/counters');

        $sourcePath = module_path('Counters', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/counters';
        }, \Config::get('view.paths')), [$sourcePath]), 'counters');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/counters');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'counters');
        } else {
            $this->loadTranslationsFrom(module_path('Counters', 'Resources/lang'), 'counters');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
//        if (! app()->environment('production') && $this->app->runningInConsole()) {
//            app(Factory::class)->load(module_path('Counters', 'Database/factories'));
//        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
