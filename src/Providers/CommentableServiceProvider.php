<?php

namespace Habib\Commentable\Providers;

use Habib\Commentable\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentableServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/comment.php', 'comment'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $package_path = dirname(__DIR__);
        //publish config comment.php
        $this->publishes([
            $package_path . '/config/comment.php' => config_path('comment.php'),
        ], 'config');

        //publish views
        $this->publishes([
            $package_path . '/resources/views' => resource_path('views/vendor/commentable'),
        ], 'views');

        //publish assets
        $this->publishes([
            $package_path . '/resources/assets' => public_path('vendor/commentable'),
        ], 'assets');

        //publish migrations
        $this->publishes([
            $package_path . '/database/migrations/' => database_path('migrations')
        ], 'migrations');

        //publish migrations
        $this->publishes([
            $package_path . '/database/seeds/' => database_path('seeds')
        ], 'seeds');

        $this->loadViewsFrom($package_path . '/resources/views', 'commentable');
        $this->loadMigrationsFrom($package_path . '/database/migrations');
        $this->loadFactoriesFrom($package_path . '/database/factory');

        Route::mixin(new Router());
    }
}
