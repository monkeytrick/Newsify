<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\NewsAPIService;
use Illuminate\Support\Facades\Http;


class NewsAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(NewsAPIService::class, function($app){
            $token = config('services.NewsAPI.key');
            return new NewsAPIService($token, $app->make(Http::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
