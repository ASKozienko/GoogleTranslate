<?php
namespace ASK\GoogleTranslate\Tests\HttpClient;

use ASK\GoogleTranslate\HttpClient\BuzzHttpClient;
use Buzz\Browser;

class BuzzHttpClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnSuccessResult()
    {
        $browser = new Browser();
        $httpClient = new BuzzHttpClient($browser);

        $result = $httpClient->request('http://httpbin.org/post', array(
            'key' => 'value',
            'array' => array('value1', 'value2'),
        ), array(
            'KEY' => 'VALUE',
        ));

        var_dump($result);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('key', $result['form']);
        $this->assertEquals('value', $result['form']['key']);
        $this->assertArrayHasKey('array', $result['form']);
        $this->assertEquals('value1', $result['form']['array'][0]);
        $this->assertEquals('value2', $result['form']['array'][1]);

        $this->assertArrayHasKey('Key', $result['headers']);
        $this->assertEquals('VALUE', $result['headers']['Key']);
    }

    /**
     * @test
     * @expectedException ASK\GoogleTranslate\HttpClient\Exception\HttpClientException
     */
    public function shouldThrowHttpClientOnError()
    {
        $browser = new Browser();
        $httpClient = new BuzzHttpClient($browser);

        $httpClient->request('http://httpbin.org/status/500', array());
    }
}
