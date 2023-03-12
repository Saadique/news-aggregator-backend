<?php

namespace App\Providers;

use App\Services\News\GuardianAPIService;
use App\Services\News\NewsAggregator;
use App\Services\News\NewsAPIService;
use App\Services\News\NewYorkTimesAPIService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsAPIService::class, function ($app) {
            return new NewsAPIService();
        });

        $this->app->singleton(GuardianAPIService::class, function ($app) {
            return new GuardianAPIService();
        });

        $this->app->singleton(NewYorkTimesAPIService::class, function ($app) {
            return new NewYorkTimesAPIService();
        });

        $this->app->singleton(NewsAggregator::class, function ($app) {
            $newsAPIServiceDep =  $this->app->make(NewsAPIService::class);
            $guardianAPIServiceDep = $this->app->make(GuardianAPIService::class);
            $nytAPIServiceDep = $this->app->make(NewYorkTimesAPIService::class);
            return new NewsAggregator($newsAPIServiceDep, $guardianAPIServiceDep, $nytAPIServiceDep);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
