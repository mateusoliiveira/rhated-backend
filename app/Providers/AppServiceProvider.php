<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\PublicationRepositoryInterface',
            'App\Repositories\Eloquent\PublicationRepository',
        );
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository',
        );
        $this->app->bind(
          'App\Repositories\Contracts\ProfileRepositoryInterface',
          'App\Repositories\Eloquent\ProfileRepository',
        );
        $this->app->bind(
          'App\Repositories\Contracts\FollowRepositoryInterface',
          'App\Repositories\Eloquent\FollowRepository',
      );
        $this->app->bind(
          'App\Repositories\Contracts\RatingRepositoryInterface',
          'App\Repositories\Eloquent\RatingRepository',
      );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
