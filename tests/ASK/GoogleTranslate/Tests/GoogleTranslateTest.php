<?php
namespace ASK\GoogleTranslate\Tests;

use ASK\GoogleTranslate\GoogleTranslate;

class GoogleTranslateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGenerateRequestArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2', array(
                'key' => 'api-key',
                'target' => 'en',
                'format' => 'html',
                'q' => array('text'),
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->translate('text', 'en');
    }

    /**
     * @test
     */
    public function shouldGenerateMultiSourceRequestArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2', array(
                'key' => 'api-key',
                'target' => 'en',
                'format' => 'html',
                'q' => array('text', 'text2'),
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->translate(array('text', 'text2'), 'en');
    }

    /**
     * @test
     */
    public function shouldGenerateRequestWithAllArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2', array(
                'key' => 'api-key',
                'target' => 'ru',
                'format' => 'text',
                'q' => array('text'),
                'source' => 'en',
                'prettyprint' => 'true',
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->translate('text', 'ru', 'en', 'text', true);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\ASK\GoogleTranslate\HttpClient\HttpClientInterface
     */
    protected function createHttpClientMock()
    {
        return $this->getMock('ASK\\GoogleTranslate\\HttpClient\\HttpClientInterface');
    }
}
