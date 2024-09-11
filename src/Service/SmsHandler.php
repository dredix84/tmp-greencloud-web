<?php


namespace App\Service;

use Cake\Core\Configure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class SmsHandler
{
    /** @var Client */
    private $client;

    /** @var array */
    private $queryParams;

    /** @var string */
    private $number;

    /** @var string */
    private $message;

    /** @var bool */
    private $errored;

    /** @var int */
    private $sendAttempts;

    /**
     * SmsHandler constructor.
     * @param string $number
     * @param string $message
     */
    public function __construct($number = '', $message = '')
    {
        $this->number = $number;
        $this->message = $message;
        $this->errored = false;
        $this->sendAttempts = 0;

        $this->client = new Client([
            'base_uri' => Configure::read('sms.base_uri'),
            'timeout' => 2.0,
        ]);

        $this->queryParams = Configure::read('sms.params');
    }

    /**
     * Trigger a SMS send attempt
     * @return bool|string
     */
    public function sendSms()
    {
        if ($this->valid() === false) {
            return false;
        }

        $statusCode = null;
        $this->sendAttempts++;

        try {
            $response = $this->client->request(
                'GET',
                Configure::read('sms.base_uri'),
                [
                    'query' => $this->getQueryParams()
                ]
            );

            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode <= 299) {
                return $this->getContent($response);
            }

            LogHandler::warning(
                'SmsHandler: There was an issue while attempting to send a SMS.',
                $this->getQueryParams() + [
                    'statusCode' => $statusCode
                ]
            );
//            $this->errored = true;
            return false;

        } catch (GuzzleException $e) {
            LogHandler::error(
                'SmsHandler: There was an error while attempting to send a SMS. Details: ' . $e->getMessage(),
                $this->getQueryParams() + [
                    'statusCode' => $statusCode
                ]
            );
            $this->errored = true;
            return false;
        }
    }

    public function sendSmsWithRetry()
    {
        $result = $this->sendSms();
        if ($result === false) {
            $result = $this->sendSms();
        }

        return $result;
    }

    /**
     * Used to determine if the message is valid for sending
     * @return bool
     */
    public function valid()
    {
        $outValue = true;
        if (empty($this->number) || empty($this->message)) {
            LogHandler::warning(
                'SmsHandler: The message failed validation as the number or message was empty.',
                $this->getQueryParams()
            );
            $outValue = false;
        }

        return $outValue;
    }

    /**
     * Sets a query parameter
     * @param $key
     * @param $value
     */
    public function setQueryParam($key, $value)
    {
        $this->queryParams[$key] = $value;
    }

    public function getQueryParams()
    {
        $outData = $this->queryParams;
        $outData['number'] = $this->number;
        $outData['message'] = $this->message;

        return $outData;
    }

    /**
     * Gets the response content
     * @param Response $response
     * @return bool|string
     */
    protected function getContent(Response $response)
    {
        $body = $response->getBody();
        return trim($body->getContents());
    }


    /**
     * Returns the full query string which will be used for the request.
     * @return string
     */
    public function getQueryString()
    {
        return http_build_query($this->getQueryParams());
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return SmsHandler
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return SmsHandler
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return bool
     */
    public function isErrored()
    {
        return $this->errored;
    }

    /**
     * @return int
     */
    public function getSendAttempts()
    {
        return $this->sendAttempts;
    }
}
