<?php

namespace CAP\actions;

use CAP\Exception\ExceptionDatabaseSettings;
use CAP\model\settings\DatabaseFieldSetting;

class CpamaticaAutoPostsSettings
{
    /**
     * Get field by name
     *
     * @param $fieldSetting
     * @return string|void
     */
    static function getField($fieldSetting)
    {
        try {
            return DatabaseFieldSetting::get($fieldSetting);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }

    /**
     * Get Api Phrase setting
     *
     * @return string|void
     */
    static function getApiPhrase()
    {
        try {
            return DatabaseFieldSetting::get(CPAMATICA_TABLE_FIELD_API_PHRASE);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }

    /**
     * Get Author setting
     *
     * @return string|void
     */
    static function getAuthor()
    {
        try {
            return DatabaseFieldSetting::get(CPAMATICA_TABLE_FIELD_AUTHOR);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }

    /**
     * Get url posts
     *
     * @return string|void
     */
    static function getUrlPosts()
    {
        try {
            return DatabaseFieldSetting::get(CPAMATICA_TABLE_FIELD_URL);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }

    /**
     * Get Post Type Setting
     *
     * @return string|void
     */
    static function getPostType()
    {
        try {
            return DatabaseFieldSetting::get(CPAMATICA_AP_DEF_TYPE_POST);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }

    /**
     * Get Auth Key setting
     *
     * @return string|void
     */
    static function getAuthKey()
    {
        try {
            return DatabaseFieldSetting::get(CPAMATICA_TABLE_FIELD_URL_A_KEY);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }

    /**
     * Get Auth Vak setting
     *
     * @return string|void
     */
    static function getAuthVal()
    {
        try {
            return DatabaseFieldSetting::get(CPAMATICA_TABLE_FIELD_URL_A_VAL);
        } catch (ExceptionDatabaseSettings | \Exception $e) {
            error_log($e);
        }
    }
}
