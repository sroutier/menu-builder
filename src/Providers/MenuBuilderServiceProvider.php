<?php namespace Sroutier\MenuBuilder\Providers;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Sroutier\MenuBuilder\Managers\MenuBuilderManager;

class MenuBuilderServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Use this if your packages has migrations.
        $this->setupMigrations();

        // Use this if your packages has seeds.
        $this->setupSeeds();

        // Use this if your package has a config file.
        $this->setupConfig();

        // Use this if your package has routes.
        $this->setupRoutes($this->app->router);

        // Use this if your package has views.
        $this->setupViews();

        // Use this if your package has translations
        $this->setupTranslations();

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Bind to the key 'MenuBuilder' to a closure instantiating to the MenuBuilderManager.
        $this->app->bind('MenuBuilder', function($app) {
            return new MenuBuilderManager($app);
        });
    }


    /**
     * Publish the migrations for the package
     */
    public function setupMigrations()
    {
        // Use this if your package publishes migration files.
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'migrations');

    }

    /**
     * Publish the seeds for the package
     */
    public function setupSeeds()
    {
        // Use this if your package publishes seed files.
        $this->publishes([
            __DIR__.'/../../database/seeds/' => database_path('seeds')
        ], 'seeds');

    }

    /**
     * Define and publish the config for the package
     */
    public function setupConfig()
    {
        // Use this if your package has a config file.
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'menu-builder');
        // Use this if your package publishes a config file.
        $this->publishes( [
            __DIR__ . '/../../config/config.php' => config_path('menu-builder.php'),
        ], 'config');
    }

    /**
     * Define and config the routes for the package.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // Use this if your package has a route.
        $router->group(['namespace' => 'Sroutier\MenuBuilder\Http\Controllers'], function($router)
        {
            require __DIR__.'/../Routes/routes-menu-builder.php';
        });
        // Use this if your package publishes a route file.
        $this->publishes( [
            __DIR__ . '/../Routes/routes-menu-builder.php' => app_path().DIRECTORY_SEPARATOR."Http".DIRECTORY_SEPARATOR.'routes-menu-builder.php',
        ], 'routes');
    }

    /**
     * Define and publish the views for the package
     */
    public function setupViews()
    {

        // Use this if your package has views.
        $this->loadViewsFrom(__DIR__ . '/../../views', 'menu-builder');
        // Use this if your package publishes views.
        $this->publishes( [
                            __DIR__ . '/../../views' => base_path('resources/views/vendor/menu-builder')
                          ], 'views');
    }

    /**
     * Define the translations for the package
     */
    public function setupTranslations()
    {
        // Use this if your package has translations
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../../lang'), 'menu-builder');
        // Use this if your package publishes translations
        $this->publishes( [
            __DIR__ . '/../../lang' => base_path('resources/lang/vendor/menu-builder')
        ], 'translations');
    }

}
