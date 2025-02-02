<?php

namespace IpApi;

use IpApi\Location;

/**
 * Class IpApi.
 *
 * A main wrapper over the IpApi api.
 *
 * @package IpApi
 */
class IpApi
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * API endpoint address.
     *
     * @var string
     */
    protected $endpoint = 'https://ipapi.co/';
    
    /**
     * Initializes a new instance with key.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Builds a location object from received parsed data.
     *
     * @param mixed[] $data
     * @return \IpApi\Location
     */
    protected function buildLocation(array $data)
    {
        return new Location($data);
    }

    /**
     * Builds an url with received address to check.
     *
     * @param string $address
     * @return string
     */
    protected function buildUrl($address)
    {
        $url = '';

        if (empty($this->apiKey)) {
            $url = $this->endpoint . $address . '/json/';
        } else {
            $url = $this->endpoint . $address . '/json/?key=' . $this->apiKey;
        }

        return $url;
    }

    /**
     * Fetches a response from the url received.
     *
     * @param string $url
     * @return bool|string
     */
    protected function fetch($url)
    {
        return file_get_contents($url);
    }

    /**
     * Locates the received address over api.
     *
     * @param string $address
     * @return \IpApi\Location
     */
    public function lookup($address)
    {
        $url = $this->buildUrl($address);
        $data = $this->fetch($url);
        $parsed = $this->parse($data);
        $location = $this->buildLocation($parsed);

        return $location;
    }

    /**
     * Parses the received data.
     *
     * @param string $data
     * @return mixed
     */
    protected function parse($data)
    {
        return json_decode($data, true);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

}
