<?php


namespace App\Services;


use GuzzleHttp\Client;

class APIService
{
    protected $APIClient;
    protected $APILibrary;
    protected $apiKey;
    protected $apiToken;
    protected $url;

    public function __construct()
    {
        $this->APIClient = new Client();
    }

}
