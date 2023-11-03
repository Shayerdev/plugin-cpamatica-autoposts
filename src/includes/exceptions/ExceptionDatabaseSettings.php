<?php

namespace CAP\Exception;

class ExceptionDatabaseSettings extends \Exception
{
    private $url;

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function displayErrorNotice()
    {
        add_action('admin_notices', function () {
            $message = $this->getMessage();
            $url = $this->url;
            echo "<div class='error'><p>Error Database: $message. <a href='$url'>Back to the page</a></p></div>";
        });
    }
}
