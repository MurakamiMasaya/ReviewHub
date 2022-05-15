<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SearchRepositoryInterface;
use App\Repositories\SearchRepository;
use App\Interfaces\DisplayRepositoryInterface;
use App\Repositories\DisplayRepository;
use App\Interfaces\ImageRepositoryInterface;
use App\Repositories\ImageRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchRepositoryInterface::class, SearchRepository::class);
        $this->app->bind(DisplayRepositoryInterface::class, DisplayRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
