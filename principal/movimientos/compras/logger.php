<?php

class FileLogger
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function log($message)
    {
        file_put_contents($this->file, $message . PHP_EOL, FILE_APPEND);
    }
}
