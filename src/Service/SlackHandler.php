<?php


namespace App\Service;


use App\Model\Entity\Merchant;
use Cake\Log\Log;
use GuzzleHttp\Client;

class SlackHandler
{
    /** @var string|null */
    private $alertUrl;

    /** @var Client */
    private $client;

    /** @var array */
    private $message = [];

    /** @var string */
    private $webHook;

    const NEW_MERCHANT_MESSAGE_TEMPLATE = "New merchant signup\n:office:*Name:* %s\n:information_source:*Industry:* %s";

    public function __construct($webHook = null)
    {
        $this->$webHook = $webHook !== null ? $webHook : env('SLACK_PROD_ALERTS_URL');

        $this->client = new Client(['base_uri' => $this->alertUrl]);
    }

    public static function newMerchantNotification(Merchant $merchant)
    {
        $messageTemplate = sprintf(
            self::NEW_MERCHANT_MESSAGE_TEMPLATE,
            $merchant->business_title,
            $merchant->has('industry') ? $merchant->industry->title : '--'
        );

        $slack = new SlackHandler('https://hooks.slack.com/services/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');
        return $slack->addMessage($messageTemplate)
            ->send();
    }


    public function clearMessages()
    {
        $this->message = [];
    }

    /**
     * @param bool $clearMessageAfter Should the message array be cleared after the message has been sent.
     *
     * @return bool|string
     */
    public function send($clearMessageAfter = true)
    {
        if (count($this->message) === 0) {
            return false;
        }
        if (empty($this->webHook)) {
            Log::warning('A valid slack web hook was not supplied');

            return false;
        }

        $curl = curl_init();

        $messageBlocks = json_encode(['blocks' => $this->message]);
        Log::debug('Slack message: ' . $messageBlocks);

        curl_setopt_array($curl, [
            CURLOPT_URL            => $this->webHook,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $messageBlocks,
            CURLOPT_HTTPHEADER     => array(
                "content-type: application/json"
            ),
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($clearMessageAfter) {
            $this->clearMessages();
        }

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

    /**
     * @param $message
     * @param null $imageUrl
     * @param string $imageAltText
     *
     * @return SlackHandler
     */
    public function addMessage($message, $imageUrl = null, $imageAltText = '')
    {
        $messageParts = [
            "type" => "section",
            "text" => [
                "type" => "mrkdwn",
                "text" => $message
            ]
        ];

        if ($imageUrl) {
            $messageParts['accessory'] = [
                "type"      => "image",
                "image_url" => $imageUrl,
                "alt_text"  => !empty($imageAltText) ? $imageAltText : 'Image'
            ];
        }

        $this->message[] = $messageParts;

        return $this;
    }

    /**
     * @return $this
     */
    public function addDivider()
    {
        $this->message[] = ["type" => "section", "type" => "divider"];

        return $this;
    }

    /**
     * @param $messages
     *
     * @return $this
     */
    public function addContext($messages)
    {
        $parts = [];
        if (is_string($messages)) {
            $parts = [$messages];
        } elseif (is_array($messages)) {
            $parts = $messages;
        }

        $fullContextMessage = [
            "type"     => "context",
            "elements" => []
        ];

        foreach ($parts as $part) {
            $fullContextMessage['elements'][] = [
                "type" => "mrkdwn",
                "text" => $part . "\n\n"
            ];
        }
        $this->message[] = $fullContextMessage;

        return $this;
    }

    /**
     * @param $imageUrl
     * @param $title
     *
     * @return $this
     */
    public function addImage($imageUrl, $title)
    {
        $this->message[] = [
            "type"      => "image",
            "title"     => [
                "type"  => "plain_text",
                "text"  => $title,
                "emoji" => true
            ],
            "image_url" => $imageUrl,
            "alt_text"  => $title
        ];

        return $this;
    }

    /**
     * Add an array of actions to the message
     * @param array $actions
     *
     * @return $this
     */
    public function addAction($actions)
    {
        $this->message[] = [
            "type"     => "actions",
            "elements" => $actions
        ];

        return $this;
    }

    /**
     * Returns an instance of a action button
     * @param string $title
     * @param string $url
     *
     * @return array
     */
    public function actionButtons($title, $url)
    {
        return [
            "type" => "button",
            "text" => [
                "type" => "plain_text",
                "text" => $title
            ],
            "url"  => $url
        ];
    }

    /**
     * @return string
     */
    public function getWebHook()
    {
        return $this->webHook;
    }

    /**
     * @param string $webHook
     * @return SlackHandler
     */
    public function setWebHook($webHook)
    {
        $this->webHook = $webHook;
        return $this;
    }
}
