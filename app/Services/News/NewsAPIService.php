<?php


namespace App\Services\News;

use App\Services\APIService;
use jcobhams\NewsApi\NewsApi;

class NewsAPIService extends APIService
{
    public function __construct()
    {
        parent::__construct();
        $this->apiKey = "ddf752c71dc14a1d9c295d6c3ec93abd";
        $this->APILibrary = new NewsApi($this->apiKey);
        $this->url = "https://newsapi.org/v2";
    }

    public function getNews($search, $sources, $language, $from, $to)
    {
        $query = [
            'apiKey' => $this->apiKey,
            'searchIn' => ["title", "content", "description"],
            'q' => "a",
            'pageSize' => 20
        ];

        if (!empty($search)){
            $query['q'] = $search;
        }

        if (!empty($sources)){
            $query['sources'] = $sources;
        }

        if(!empty($language)){
            $query['language'] = $language;
        }

        if (!empty($from)) {
            $query['from'] = $from;
        }

        if (!empty($to)) {
            $query['to'] = $to;
        }


        $response = $this->APIClient->request('GET', "$this->url/everything", [
            'query' => $query
        ]);

        $json_decoded = json_decode($response->getBody(), true);

        if (isset($json_decoded) && !empty($json_decoded) && !empty($json_decoded['articles'])){
            return $json_decoded['articles'];
        }else{
            return [];
        }
    }


    public function getTopNews()
    {
        $response = $this->APIClient->request('GET', 'https://newsapi.org/v2/top-headlines', [
            'query' => [
                'apiKey' => $this->apiKey,
                'country' => 'nl'
            ]
        ]);

        $news = json_decode($response->getBody(), true);
        $news = $news['articles'];
        return $news;
    }


}
