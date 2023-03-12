<?php

namespace App\Services\News;

class NewsAggregator
{
    private $newsAPIService;
    private $guardianAPIService;
    private $nytAPIService;

    public function __construct(NewsAPIService $newsAPIService, GuardianAPIService $guardianAPIService, NewYorkTimesAPIService $nytAPIService)
    {
        $this->newsAPIService = $newsAPIService;
        $this->guardianAPIService = $guardianAPIService;
        $this->nytAPIService = $nytAPIService;
    }

    public function getAllNews($data)
    {
        $newsAPIData = $this->newsAPIService->getNews($data['search'], $data['sources'], $data["language"], $data["from"], $data["to"]);
        $formattedNewsAPIData = array_map(function ($item){
            return[
                'source' => 'The News API',
                'title' => $item['title'],
                'description' => $item['description'],
                'url' => $item['url'],
                'image_url' => $item['urlToImage'],
                'published_at' => $item['publishedAt']
            ];
        }, $newsAPIData);

        $guardianAPIData = $this->guardianAPIService->getNews($data['search'], $data['sources'], $data['category'], $data['from'], $data['to']);
        $formattedGuardianAPIData = array_map(function($item) {
            return [
                'source' => "The Guardian",
                'title' => $item['webTitle'],
                'description' => isset($item['fields']['bodyText']) ? $item['fields']['bodyText'] : null,
                'url' => $item['webUrl'],
                'image_url' => isset($item['fields']['thumbnail']) ? $item['fields']['thumbnail'] : null,
                'published_at' => $item['webPublicationDate']
            ];
        }, $guardianAPIData);


        $nytAPIData = $this->nytAPIService->getNews($data['search'], $data['sources'], $data['language'], $data['from'], $data['to']);
//        dd($nytAPIData);
        $formattedNytAPIData = array_map(function($item) {
            return [
                "source" => "New York Times",
                'title' => $item['headline']['main'],
                'description' => $item['abstract'],
                'url' => $item['web_url'],
                'image_url' => isset($item['multimedia'][0]['url']) ? "https://static01.nyt.com/".$item['multimedia'][0]['url'] : null,
                'published_at' => $item['pub_date']
            ];
        }, $nytAPIData);

        return array_merge($formattedNewsAPIData, $formattedNytAPIData, $formattedGuardianAPIData);
    }

    public function getNewsByCategory($data)
    {
        $guardianAPIData = $this->guardianAPIService->getNews($data['search'], $data['sources'], $data['category'], $data['from'], $data['to']);
        $formattedGuardianAPIData = array_map(function($item) {
            return [
                'source' => "The Guardian",
                'title' => $item['webTitle'],
                'description' => isset($item['fields']['bodyText']) ? $item['fields']['bodyText'] : null,
                'url' => $item['webUrl'],
                'image_url' => isset($item['fields']['thumbnail']) ? $item['fields']['thumbnail'] : null,
                'published_at' => $item['webPublicationDate']
            ];
        }, $guardianAPIData);

        return $formattedGuardianAPIData;
    }
}
