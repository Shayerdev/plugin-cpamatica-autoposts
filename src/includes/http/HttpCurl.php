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
    protected $url = "";

    /**
     * Http method
     *
     * @var string
     */
    protected $method = "GET";

    /**
     * Content type
     *
     * @var string
     */
    protected $contentType = "text/html";

    /**
     * Accept Content
     *
     * @var string
     */
    protected $acceptContent = "application/x-www-form-urlencoded";

    /**
     * Parse response data to Json
     *
     * @var bool
     */
    protected $jsonParse = false;

    public function __construct()
    {
    }

    /**
     * Set Url query
     *
     * @param $url
     * @return void
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * Set Method POST|GET|PATCH|DELETE
     *
     * @param $method
     * @return void
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * Set Content Type
     *
     * @param $ct
     * @return void
     */
    public function setContentType($ct): void
    {
        $this->contentType = $ct;
    }

    /**
     * Set Content accept
     *
     * @param $ca
     * @return void
     */
    public function setContentAccept($ca): void
    {
        $this->acceptContent = $ca;
    }

    /**
     * Set Json parse
     *
     * @param $json
     * @return void
     */
    public function setJsonParse($json): void
    {
        $this->jsonParse = $json;
    }

    /**
     * Query to another site api
     *
     * @param $headers
     * @return array|string
     * @throws ExceptionHttpResponse
     */
    public function query($headers): array|string
    {


        $combinedString = '';
        if (isset($headers)) {
            $combinedString = $headers['key'] . ': ' . $headers['val'];
        }

        $curl = curl_init();
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
        curl_close($curl);
        if ($httpStatusCode === 200 || $httpStatusCode === 201) {
            return json_decode($response);
        } else {
            throw new ExceptionHttpResponse('Some problem with service. Data not found');
        }
    }
}
