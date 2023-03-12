<?php


namespace App\Services\News;


use App\Services\APIService;

class GuardianAPIService extends APIService
{

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = "b88f5c4a-e6ef-4c0c-8914-da944ade3801";
        $this->url = "https://content.guardianapis.com";
    }

    public function getNews($search, $source, $section, $from, $to)
    {
        $query = [
            'api-key' => $this->apiKey,
        ];

        if (!empty($search)){
            $query['q'] = $search;
        }

        if(!empty($source)){
            $query['source'] = $source;
        }

        if(!empty($section)){
            $query['section'] = $section;
        }

        if (!empty($from)) {
            $query['from-date'] = $from;
        }

        if (!empty($to)) {
            $query['to-date'] = $to;
        }


        $response = $this->APIClient->request('GET', "$this->url/search", [
            'query' => $query
        ]);

        $json_decoded = json_decode($response->getBody(), true);

        if (isset($json_decoded['response']['results']) && !empty($json_decoded['response']['results'])){
            return $json_decoded['response']['results'];
        }else{
            return [];
        }
    }
}
