<?php


namespace App\Services\News;


use App\Services\APIService;

class NewYorkTimesAPIService extends APIService
{
    public function __construct()
    {
        parent::__construct();
        $this->apiKey = "qQMAWxgOiku5385lZgrgUAnbPabnBZuv";
        $this->url = "https://api.nytimes.com/svc/search/v2/articlesearch.json";
    }

    public function getNews($search, $source, $language, $beginDate, $endDate)
    {
        $query = [
            'api-key' => $this->apiKey,
        ];

        if (!empty($search)){
            $query['q'] = $search;
        }

        if (!empty($source)){
            $query['sources'] = $source;
        }

        if(!empty($language)){
            $query['language'] = $language;
        }

        if (!empty($from)) {
            $query['begin_date'] = $beginDate;
        }

        if (!empty($to)) {
            $query['end_date'] = $endDate;
        }

        $response = $this->APIClient->request('GET', $this->url, [
            'query' => $query
        ]);

        $json_decoded = json_decode($response->getBody(), true);

        if (isset($json_decoded['response']['docs']) && !empty($json_decoded['response']['docs'])){
            return $json_decoded['response']['docs'];
        }else{
            return [];
        }
    }

}
