<?php

namespace App\Providers;

use App\Repositories\Post\IPostRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Register\IRegisterRepository;
use App\Repositories\Register\RegisterRepository;
use App\Services\Cache\CacheService;
use App\Services\Cache\ICacheService;
use App\Services\Login\ILoginService;
use App\Services\Login\LoginService;
use App\Services\Post\IPostService;
use App\Services\Post\PostService;
use App\Services\Register\IRegisterService;
use App\Services\Register\RegisterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IRegisterService::class, RegisterService::class);
        $this->app->bind(IRegisterRepository::class, RegisterRepository::class);
        $this->app->bind(ILoginService::class, LoginService::class);
        $this->app->bind(IPostService::class, PostService::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(ICacheService::class, CacheService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
