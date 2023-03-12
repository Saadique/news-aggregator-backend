<?php


namespace App\Http\Controllers;


use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsRepository;


    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getNews(Request $request)
    {
        $body = $request->all();

        $data = [
            'search' => $body['search'] ?? "",
            'sources' => $body['sources'] ?? "",
            'category' => $body['category'] ?? "",
            'language' => $body['language'] ?? null,
            'from' => $body['from'] ?? null,
            'to' => $body['to'] ?? null
        ];

        $news = $this->newsRepository->getNewsTest($data);
        return response()->json($news);
    }
}
