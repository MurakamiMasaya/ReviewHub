<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Services\{DisplayServiceInterface,
    CompanyServiceInterface,
    SchoolServiceInterface,
    EventServiceInterface,
    ArticleServiceInterface,
    ImageServiceInterface,
    MailServiceInterface};
    
use App\Services\{DisplayService,
    CompanyService,
    SchoolService,
    EventService,
    ArticleService,
    ImageService,
    MailService};

use App\Interfaces\Repositories\{DisplayRepositoryInterface,
    CompanyRepositoryInterface,
    SchoolRepositoryInterface,
    EventRepositoryInterface,
    ArticleRepositoryInterface};

use App\Repositories\{DisplayRepository,
    CompanyRepository,
    SchoolRepository,
    EventRepository,
    ArticleRepository};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DisplayServiceInterface::class, DisplayService::class);
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(SchoolServiceInterface::class, SchoolService::class);
        $this->app->bind(EventServiceInterface::class, EventService::class);
        $this->app->bind(ArticleServiceInterface::class, ArticleService::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);

        $this->app->bind(DisplayRepositoryInterface::class, DisplayRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageService::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
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
