<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/19/2019
 * Time: 1:53 PM
 */

namespace App\Http\Repositories\Eloquent;


use App\Http\Repositories\Contracts\SearchApiRepositoryInterface;
use GuzzleHttp\Client;

class SearchApiRepository implements SearchApiRepositoryInterface
{
    protected $baseUrl;
    protected $apiKey;

    /**
     * SearchApiRepository constructor.
     */
    public function __construct()
    {
        $this->baseUrl = config('global.youtube.data_api_url');
        $this->apiKey = config('global.youtube.data_api_key');
    }

    public function searchByName($keyWord)
    {
        $client = new Client();
        try {
            $response = $client->request('GET', 'https://www.googleapis.com/youtube/v3/search?type=video&maxResults=20&part=snippet&q='. $keyWord . ' karaoke' .'&key=' . $this->apiKey);
            return json_decode($response->getBody()->getContents());
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}