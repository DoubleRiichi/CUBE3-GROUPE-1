<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YouTubeService;

class YouTubeController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function index(Request $request)
    {
        $query = $request->input('query', 'latest movies');
        $trailers = $this->youtubeService->getMovieTrailers($query);

        return view('youtube.index', compact('trailers'));
    }
}

