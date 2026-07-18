<?php

namespace App\Http\Middleware;

use App\Services\SeoService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultSeo
{
    protected SeoService $seo;

    public function __construct(SeoService $seo)
    {
        $this->seo = $seo;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set default SEO for all pages except admin panel or JSON requests
        if (!$request->is('admin/*') && !$request->is('api/*') && !$request->expectsJson()) {
            $this->seo
                ->setBasicSeo(
                    config('app.name', 'Vigyanmev Jayate'),
                    config('seo.default_description', 'Professional Laravel development services')
                )
                ->setRobots('index, follow')
                ->setCurrentUrlAsCanonical();
        }

        return $next($request);
    }
}
