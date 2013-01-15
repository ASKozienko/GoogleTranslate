<?php
namespace ASK\GoogleTranslate\Tests\Functional;

use ASK\GoogleTranslate\GoogleTranslate;
use ASK\GoogleTranslate\HttpClient\BuzzHttpClient;
use Buzz\Browser;
use Buzz\Client\Curl;

class GoogleTranslateTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (!isset($_ENV['GOOGLE_API_KEY'])) {
            $this->markTestSkipped('The Google API key is not configured.');
        }
    }

    /**
     * @test
     */
    public function shouldTranslateAndGuessSourceLanguage()
    {
        $curl = new Curl();
        $browser = new Browser($curl);
        $httpClient = new BuzzHttpClient($browser);
        $googleTranslate = new GoogleTranslate($httpClient, $_ENV['GOOGLE_API_KEY']);

        $result = $googleTranslate->translate('test', 'ru');

        $this->assertArrayHasKey('translatedText', $result[0]);
        $this->assertEquals('тест', $result[0]['translatedText']);
        $this->assertArrayHasKey('detectedSourceLanguage', $result[0]);
        $this->assertEquals('en', $result[0]['detectedSourceLanguage']);
    }

    /**
     * @test
     */
    public function shouldTranslateWithGivenSourceLanguage()
    {
        $curl = new Curl();
        $browser = new Browser($curl);
        $httpClient = new BuzzHttpClient($browser);
        $googleTranslate = new GoogleTranslate($httpClient, $_ENV['GOOGLE_API_KEY']);

        $result = $googleTranslate->translate('test', 'ru', 'en');

        $this->assertArrayHasKey('translatedText', $result[0]);
        $this->assertEquals('тест', $result[0]['translatedText']);
        $this->assertArrayNotHasKey('detectedSourceLanguage', $result[0]);
    }
}
