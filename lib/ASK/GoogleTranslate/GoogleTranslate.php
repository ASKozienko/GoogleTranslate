<?php
namespace ASK\GoogleTranslate;

use ASK\GoogleTranslate\HttpClient\HttpClientInterface;

class GoogleTranslate
{
    const FORMAT_HTML = 'html';

    const FORMAT_TEXT = 'text';

    /**
     * @var string
     */
    const TRANSLATE_URL = 'https://www.googleapis.com/language/translate/v2';

    /**
     * @var string
     */
    const LANGUAGES_URL = 'https://www.googleapis.com/language/translate/v2/languages';

    /**
     * @var string
     */
    const DETECT_URL = 'https://www.googleapis.com/language/translate/v2/detect';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var \ASK\GoogleTranslate\HttpClient\HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $headers = array(
        'X-HTTP-Method-Override' => 'GET',
    );

    /**
     * @param \ASK\GoogleTranslate\HttpClient\HttpClientInterface $httpClient
     * @param string $apiKey - google API key
     */
    public function __construct(HttpClientInterface $httpClient, $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    /**
     * Translates source text from source language to target language
     *
     * @param string|array $sourceText - source text
     * @param string $sourceLanguage - source language
     * @param string $targetLanguage - target language
     * @param string $format - this optional parameter allows you to indicate that the text to be translated is either plain-text or HTML.
     * @param bool $prettyprint - returns a response with indentations and line breaks
     * @return array
     */
    public function translate($sourceText, $targetLanguage, $sourceLanguage = '', $format = self::FORMAT_HTML, $prettyprint = false)
    {
        $parameters = array();
        $parameters['key'] = $this->apiKey;
        $parameters['target'] = $targetLanguage;
        $parameters['format'] = $format;
        $parameters['q'] = (array) $sourceText;

        if ($sourceLanguage) {
            $parameters['source'] = $sourceLanguage;
        }

        if ($prettyprint) {
            $parameters['prettyprint'] = 'true';
        }

        $result = $this->httpClient->request(self::TRANSLATE_URL, $parameters, $this->headers);

        return $result['data']['translations'];
    }

    /**
     * List the source and target languages supported by the translate methods
     *
     * @param string $target - target language
     * @param bool $prettyprint - returns a response with indentations and line breaks
     */
    public function languages($target, $prettyprint = false)
    {

    }

    /**
     * Detect language of source text
     *
     * @param $sourceText - the text to be detected
     * @param $prettyprint - returns a response with indentations and line breaks
     *
     */
    public function detect($sourceText,  $prettyprint = false)
    {

    }
}

