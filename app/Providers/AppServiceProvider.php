<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\NavigationMenuComposer;
use App\Services\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SeoService::class, function ($app) {
            return new SeoService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', NavigationMenuComposer::class);

        // Set default SEO for admin panel and disable indexation
        if (request()->is('admin') || request()->is('admin/*')) {
            SEOTools::setTitle('Admin Panel - ' . config('app.name', 'Vigyanmev Jayate'));
            SEOTools::metatags()->setRobots('noindex, nofollow');
        }
    }
}
