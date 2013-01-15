<?php
namespace ASK\GoogleTranslate\HttpClient;

interface HttpClientInterface
{
    /**
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return array
     * @throws Exception\HttpClientException
     */
    public function request($url, array $parameters, array $headers = array());
}
