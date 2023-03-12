<?php


namespace App\Repositories;


use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Services\News\NewsAggregator;
use App\Services\News\NewsAPIService;

class NewsRepository implements NewsRepositoryInterface
{
    private $newsAggregator;
    public function __construct(NewsAggregator $newsAggregator)
    {
        $this->newsAggregator = $newsAggregator;
    }

    public function getNewsTest($data = [])
    {
        if(!empty($data) && !empty($data['category'])){
            return $this->newsAggregator->getNewsByCategory($data);
        }

        if(!empty($data)){
            return $this->newsAggregator->getAllNews($data);
        }
    }
}
