<?php

namespace CAP\includes\abstractions\models;

abstract class DatabaseFields
{
    abstract protected static function getField();
    abstract protected static function setField();
}
