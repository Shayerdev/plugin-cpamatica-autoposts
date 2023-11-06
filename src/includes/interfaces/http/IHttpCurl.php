<?php

namespace CAP\interfaces\http;

interface IHttpCurl
{
    public function setMethod(string $method): void;
    public function setContentType(string $ct): void;
    public function setUrl(string $url): void;
    public function setContentAccept(string $ca): void;
    public function setJsonParse(bool $json): void;
}
