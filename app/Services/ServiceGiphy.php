<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Model\Gif;
use Illuminate\Database\Eloquent\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ServiceGiphy implements ServiceGifInterface{

    const URI = "https://api.giphy.com";

    const SEARCH_PATH = "/v1/gifs/search";

    const RANDOM_PATH = "/v1/gifs/random";

    const API_KEY = "liVouohEyeKD8BLO5Vrwur6ZDJlaY0t5";

    /**
     * 
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
                'base_uri' => self::URI
            ]);
    }

    /**
     * Send the search request to Giphy API and parse the response to the model
     *
     * @param string $query
     * @param integer $length
     * @return Collection
     */
    public function search($query, $length = 25)
    {
        $response = $this->sendRequest(self::SEARCH_PATH.'?q='.$query.'&limit='.$length.'&'.$this->getKeyParam());
        $gifs = collect();
        if($response->getStatusCode() == 200){
            $gifsRaw = json_decode($response->getBody())->data;
            foreach ($gifsRaw as $gifRaw) {
                $gifs->push($this->rawObjectToModel($gifRaw));
            }
        }
        return $gifs;
    }

    /**
     * Send the random gif requesto to Giphy API and parse the response to Gif model
     *
     * @return Gif|null
     */
    public function random()
    {
        $response = $this->sendRequest(self::RANDOM_PATH.'?'.$this->getKeyParam());
        if($response->getStatusCode() == 200){
            $gifRaw = json_decode($response->getBody())->data;
            return $this->rawObjectToModel($gifRaw);
        }
        return null;
    }

    /**
     * Get api key in URL-encoded query string
     *
     * @return string
     */
    public function getKeyParam()
    {
        return 'api_key='.self::API_KEY;
    }

    /**
     * Send the request to Giphy API
     *
     * @param string $query
     * @return ResponseInterface
     */
    public function sendRequest($query)
    {
        return $this->client->get($query);
    }

    /**
     * Parse the raw object to Gif model
     *
     * @param mixed $raw
     * @return Gif
     */
    public function rawObjectToModel($raw)
    {
        $gif = new Gif([
            'title' => $raw->title, 
            'url' => $raw->images->original->url,
            'height' => $raw->images->original->height,
            'width' => $raw->images->original->width
        ]);
        return $gif;
    }
}
?>