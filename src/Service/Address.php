<?php

namespace App\Service;

use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;
use App\Model\Table\CountriesTable;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Cake\Log\Log;

/**
 * Used to resolve user addresses
 * Class Address
 * @package App\Service
 */
class Address
{
    private $baseUrl = "https://ipinfo.io/%s/geo";

    private $resolved = false;

    /** @var string $ip */
    private $ip;

    /** @var float $lat */
    private $lat;

    /** @var float $long */
    private $long;

    /** @var string $city */
    private $city;

    /** @var string $region */
    private $region;


    /** @var int $country_id */
    private $country_id;

    /** @var string $country_code */
    private $country_code;

    /** @var string $postal_code */
    private $postal_code;

    /**
     * Used to resolve user addresses
     * @param string $ip
     */
    public function __construct($ip)
    {
        if ($ip !== null) {
            $this->setIp($ip);
            $this->resolveFromIpAddress($this->getIp());
        }
    }

    public function resolveFromIpAddress($ip)
    {
        if (!empty($ip)) {
            $client = new Client();
            $url = sprintf($this->baseUrl, $ip);

            try {
                if (($resData = Cache::read($ip, '30minutes')) === false) {
                    $res = $client->request('GET', $url);
                    if ($res->getStatusCode() == 200) {
                        $resData = json_decode($res->getBody());
                        Cache::write($ip, $resData, '30minutes');
                    } else {
                        Log::write("debug", sprintf('Unable resolve address from IP address "%s" using URL "%s" due to none 200 response. Response: %s', $ip, $url, $res->getBody()));
                    }
                }

                if (isset($resData)) {
                    if (isset($resData->city)) {
                        $this->setCity($resData->city);
                    }
                    if (isset($resData->region)) {
                        $this->setRegion($resData->region);
                    }
                    if (isset($resData->loc)) {
                        $loc = explode(',', $resData->loc);
                        $this->lat = $loc[0];
                        $this->long = $loc[1];
                    }
                    if (isset($resData->country)) {
                        $this->country_code = $resData->country;
                        $this->country_id = $this->getCountryIdFromCode($resData->country);
                    }
                    if (isset($resData->postal)) {
                        $this->setPostalCode($resData->postal);
                    }
                    $this->resolved = true;     //todo: resolved should be determined by $resData
                }
            } catch (RequestException $e) {
                Log::write("debug", sprintf('Unable resolve address from IP address "%s" using URL "%s"', $ip, $url));
            }
        }
    }

    private function getCountryIdFromCode($code)
    {
        $m_Countries = TableRegistry::get('Countries');
        $country = $m_Countries->find()
            ->where(['country_code' => $code])
            ->first();
        if ($country) {
            return $country->id;
        }
        return null;
    }

    /*********************** Getters and Setters *********************************/

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     * @return Address
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function isResolved()
    {
        return $this->resolved;
    }

    /**
     * @param bool $resolved
     * @return Address
     */
    public function setResolved($resolved)
    {
        $this->resolved = $resolved;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return Address
     */
    public function setIp($ip)
    {
        $this->ip = $ip == "::1" ? '99.225.213.184 ' : $ip;
        return $this;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return Address
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param float $long
     * @return Address
     */
    public function setLong($long)
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return Address
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param int $country_id
     * @return Address
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param string $country_code
     * @return Address
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param string $postal_code
     * @return Address
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
        return $this;
    }


}
