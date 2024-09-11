<?php

namespace App\Service;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class CurrencyConverter
{

    /** @var string */
    const BASE_URL = 'https://api.currconv.com/api/v7/';

    /** @var Client */
    private $client;

    /** @var array */
    private $queryParams;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $baseCurrency;

    /** @var string */
    private $targetCurrency;

    /**
     * CurrencyConverter constructor.
     *
     * @param string $apiKey
     * @param string|null $baseCurrency
     * @param string|null $targetCurrency
     */
    public function __construct($apiKey, $baseCurrency = null, $targetCurrency = null)
    {
        $this->apiKey = $apiKey;
        $this->baseCurrency = $baseCurrency;
        $this->targetCurrency = $targetCurrency;

        $this->client = new Client([
            'base_uri' => self::BASE_URL,
            'timeout' => 2.0,
        ]);
    }


    public static function convertAmount($amount, $to = 'JMD', $from = 'USD')
    {
        $apiKey = Configure::read('currency.api_key');
        $currencyConverter = new CurrencyConverter($apiKey);
        $currencyConverter
            ->setBaseCurrency($from)
            ->setTargetCurrency($to);

        return $currencyConverter->convert($amount);
    }

    /**
     * @param float $amount
     *
     * @return float|int
     */
    public function convert($amount)
    {
        $converted = $amount * $this->getRate();

        return $converted;
    }

    public function getRate()
    {
        try {
            if ($this->baseCurrency === $this->targetCurrency) {
                $value = 1;
            } else {
                $cacheName = $this->getCurrencyKey();
                if (($value = Cache::read($cacheName, '60minutes')) === false) {
                    $response = $this->client->request(
                        'GET',
                        'convert',
                        [
                            'query' => $this->getQueryParams()
                        ]
                    );

                    $statusCode = $response->getStatusCode();
                    if ($statusCode >= 200 && $statusCode <= 299) {
                        $result = json_decode($this->getContent($response));

                        if (isset($result->{$this->getCurrencyKey()})) {
                            $value = $result->{$this->getCurrencyKey()};

                            $value = round($value);
                        }
                    }
                    Cache::write($cacheName, $value, '60minutes');
                }
            }

            return $value;
        } catch (\Exception $e) {
            LogHandler::error(
                'There was an error while attempting to get currency conversion rate. Details: ' . $e->getMessage(),
                [
                    'baseCurrency' => $this->baseCurrency,
                    'targetCurrency' => $this->targetCurrency,
                    'baseUrl' => self::BASE_URL,
                    'query' => $this->getQueryParams()
                ]
            );
        }

        return 0;
    }

    protected function getQueryParams()
    {
        return [
            'apiKey' => $this->apiKey,
            'compact' => 'ultra',
            'q' => $this->getCurrencyKey()
        ];
    }

    public function getCurrencyKey()
    {
        return sprintf('%s_%s', $this->baseCurrency, $this->targetCurrency);
    }

    protected function getContent(Response $response)
    {
        $body = $response->getBody();

        return trim($body->getContents());
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
     *
     * @return CurrencyConverter
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * @param string $baseCurrency
     *
     * @return CurrencyConverter
     */
    public function setBaseCurrency($baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getTargetCurrency()
    {
        return $this->targetCurrency;
    }

    /**
     * @param string $targetCurrency
     *
     * @return CurrencyConverter
     */
    public function setTargetCurrency($targetCurrency)
    {
        $this->targetCurrency = $targetCurrency;

        return $this;
    }
}
