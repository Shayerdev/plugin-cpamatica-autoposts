<?php

    namespace CAP\interfaces\helpers;

    interface ICreateFeatureImage
    {
        public function setImageUrl(string $imageUrl): void;
        public function insert(): int;
    }
