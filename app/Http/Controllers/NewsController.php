<?php

namespace App\Http\Controllers;

use App\Http\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Get news feed
     */
    public function feed(Request $request)
    {
        return NewsService::feed($request);
    }

    /**
     * Get news sources
     */
    public function sources(Request $request)
    {
        return NewsService::sources($request);
    }
}