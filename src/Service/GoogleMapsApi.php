<?php

namespace App\Service;

use App\Entity\Property;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

/**
 * Class MapsApi
 * @package App\Service
 */
class GoogleMapsApi extends MapsApi
{
    const ENDPOINT = "https://maps.googleapis.com/maps/api/geocode/json";

    /**
     * @var Client
     */
    private $guzzle;

    /**
     * @var string
     */
    private $key;

    /**
     * GoogleMapsApi constructor.
     */
    public function __construct(string $key)
    {
        $this->guzzle = new Client();
        $this->key = $key;
    }


    /**
     * After some investigation I concluded that in a professional enviroment I will not choose float as type
     * @return mixed
     */
    public function getLatitude()
    {
        // TODO: Implement getLatitude() method.
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        // TODO: Implement getLongitude() method.
    }

    /**
     * @param array $address
     * @return string
     */
    private function buildURL(array $address): string
    {
        $stringifyAddress = str_replace(" ", "+", implode(",", $address));

        return self::ENDPOINT."?address=". $stringifyAddress. "&key=". $this->key;
    }

    public function getData(array $address)
    {
        $endpoint = $this->buildURL(['Westminster, London SW1A 1AA']);
        $request = $this->guzzle->request('GET', $endpoint);
        $body = json_decode($request->getBody(), true);
        $a = 1;
        if ($body['status'] == "OK") {
            $geometry = $body["results"][0]["geometry"];
            if (isset($geometry["location"]["lat"])) {
                $this->setLatitude($geometry["location"]["lat"]);
            }
            if (isset($geometry["location"]["lng"])) {
                $this->setLatitude($geometry["location"]["lng"]);
            }
        }
    }
}
