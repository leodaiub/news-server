<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class NewsService
{
    /**
     * Get news feed
     */
    public static function feed(Request $request)
    {

        $mediaStackQuery = [
            "keywords" => $request->query("search"),
            "categories" => $request->query("categories"),
            "sources" => $request->query("sources"),
            "page" => $request->query("page"),
            "date" => $request->query("start_date") . "," . $request->query("end_date")
        ];

        $newsApiQuery = [
            "q" => $request->query("search") || $request->query("categories"),
            "source" => $request->query("sources"),
            "page" => $request->query("page"),
            "from" => $request->query("start_date"),
            "to" => $request->query("end_date")
        ];

        $mediaStackApi = env("MEDIASTACK_URL") . "news?access_key=" . env("MEDIA_STACK_KEY") . "&" . http_build_query($mediaStackQuery);
        $newsApi = env("NEWSAPI_URL") . "everything?apiKey=" . env("NEWSAPI_KEY") . "&" . http_build_query($newsApiQuery);

        error_log(http_build_query($request->query()));
        error_log($mediaStackApi);
        error_log($newsApi);

        $articles = array_merge(
            Http::get($mediaStackApi)->json()['data'] ?? [],
            Http::get($newsApi)->json()['articles'] ?? [],
        );

        return $articles;
    }

    /**
     * Get news sources
     */
    public static function sources(Request $request)
    {
        $newsApi = 'https://newsapi.org/v2/top-headlines/sources?apiKey=8296370e8b804aa99cbbba4a4d1b8fe5';

        return Http::get($newsApi)->json()["sources"];
    }
}