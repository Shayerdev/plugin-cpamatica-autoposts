<?php

namespace CAP\http;

use CAP\Exception\ExceptionHttpResponse;
use CAP\interfaces\http\IHttpCurl;

class HttpCurl implements IHttpCurl
{
    /**
     * Url
     *
     * @var string
     */
    public $url = "";

    /**
     * Http method
     *
     * @var string
     */
    public $method = "GET";

    /**
     * Content type
     *
     * @var string
     */
    public $contentType = "text/html";

    /**
     * Accept Content
     *
     * @var string
     */
    public $acceptContent = "application/x-www-form-urlencoded";

    /**
     * Parse response data to Json
     *
     * @var bool
     */
    public $jsonParse = false;

    public function __construct()
    {
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function setMethod($method): void
    {
        $this->method = $method;
    }

    public function setContentType($ct): void
    {
        $this->contentType = $ct;
    }

    public function setContentAccept($ca): void
    {
        $this->acceptContent = $ca;
    }

    public function setJsonParse($json): void
    {
        $this->jsonParse = $json;
    }
    public function query($headers): array
    {
        $curl = curl_init();

        $combinedString = '';
        if (isset($headers)) {
            $myArray = array('key' => 'X-Auth-w', 'val' => 'asdasd');
            $combinedString = $myArray['key'] . ': ' . $myArray['val'];
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_HTTPHEADER => array($combinedString),
        ));

        $response = curl_exec($curl);
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpStatusCode !== 200 || $httpStatusCode !== 201) {
            throw new ExceptionHttpResponse("Http return invalid data. Http status code {$httpStatusCode}");
        }

        if ($this->jsonParse) {
            return json_decode($response, true);
        }
        if (is_string($response)) {
            return [$response];
        }
        return (array)$response;
    }
}
