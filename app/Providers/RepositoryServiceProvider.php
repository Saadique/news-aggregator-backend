<?php


namespace App\Providers;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Repositories\NewsRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            NewsRepositoryInterface::class,
            NewsRepository::class
        );
    }
}
