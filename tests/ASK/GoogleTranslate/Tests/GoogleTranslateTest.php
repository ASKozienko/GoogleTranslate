<?php
namespace ASK\GoogleTranslate\Tests;

use ASK\GoogleTranslate\GoogleTranslate;

class GoogleTranslateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGenerateTranslateRequestArguments()
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
    public function shouldGenerateMultiSourceTranslateRequestArguments()
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
    public function shouldGenerateTranslateRequestWithAllArguments()
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
     * @test
     */
    public function shouldGenerateLanguagesRequestArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2/languages', array(
                'key' => 'api-key',
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->languages();
    }

    /**
     * @test
     */
    public function shouldGenerateLanguagesRequestWithAllArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2/languages', array(
                'key' => 'api-key',
                'target' => 'lang',
                'prettyprint' => 'true',
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->languages('lang', true);
    }

    /**
     * @test
     */
    public function shouldGenerateDetectRequestArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2/detect', array(
                'key' => 'api-key',
                'q' => array('text'),
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->detect('text');
    }

    /**
     * @test
     */
    public function shouldGenerateMultiSourceDetectRequestArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2/detect', array(
                'key' => 'api-key',
                'q' => array('text', 'text2'),
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->detect(array('text', 'text2'));
    }

    /**
     * @test
     */
    public function shouldGenerateDetectRequestWithAllArguments()
    {
        $httpClient = $this->createHttpClientMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('https://www.googleapis.com/language/translate/v2/detect', array(
                'key' => 'api-key',
                'q' => array('text'),
                'prettyprint' => 'true',
            ), array(
                'X-HTTP-Method-Override' => 'GET'
            ))
        ;

        $googleTranslate = new GoogleTranslate($httpClient, 'api-key');
        $googleTranslate->detect('text', true);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\ASK\GoogleTranslate\HttpClient\HttpClientInterface
     */
    protected function createHttpClientMock()
    {
        return $this->getMock('ASK\\GoogleTranslate\\HttpClient\\HttpClientInterface');
    }
}
