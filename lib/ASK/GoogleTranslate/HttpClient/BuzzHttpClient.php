<?php
namespace ASK\GoogleTranslate\HttpClient;

use ASK\GoogleTranslate\HttpClient\Exception\HttpClientException;
use Buzz\Browser;

class BuzzHttpClient implements HttpClientInterface
{
    /**
     * @var \Buzz\Browser
     */
    protected $browser;

    /**
     * @param \Buzz\Browser $browser
     */
    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws Exception\HttpClientException
     */
    public function request($url, array $parameters, array $headers = array())
    {
        $response = $this->browser->post($url, $this->normalizeHeaders($headers),
            $this->createQueryString($parameters));

        if($response->isOk()) {
            return json_decode($response->getContent(), true);
        }

        throw new HttpClientException();
    }

    /**
     * @param $headers
     * @return array
     */
    protected function normalizeHeaders($headers)
    {
        $pairs = array();
        foreach ($headers as $key => $value) {
            $pairs[] = $key . ': ' . $value;
        }

        return $pairs;
    }

    /**
     * @param array $parameters
     * @return string
     */
    protected function createQueryString(array $parameters)
    {
        $pieces = array();
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $value2) {
                    $pieces[] = $key . '=' . urlencode($value2);
                }
            } else {
                $pieces[] = $key . '=' . urlencode($value);
            }
        }

        return implode('&', $pieces);
    }
}
