<?php

namespace CAP\interfaces\helpers;

interface ICreatePost
{
    public function setTitle(string $title): void;
    public function setContent(string $content): void;
    public function setCategory(int $id): void;
    public function setStatusPost(string $status): void;
    public function setTypePost(string $typePost): void;
    public function setMetaField(array $metaFields): void;
    public function insert(): int;
}
