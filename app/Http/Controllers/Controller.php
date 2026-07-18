<?php

namespace App\Http\Controllers;

use App\Services\SeoService;

abstract class Controller
{
    protected SeoService $seo;

    public function __construct(SeoService $seo)
    {
        $this->seo = $seo;
    }
}
