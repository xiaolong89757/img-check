<?php
class logger
{
    protected $path;

    protected $logName;

    public function __construct($path = DIRECTORY_SEPARATOR, $logName = 'error_img.txt')
    {
        $this->path = $path;
        $this->logName = $logName;
    }

    public function log($data)
    {
        // echo $data . "\n";
        file_put_contents($this->path . DIRECTORY_SEPARATOR . $this->logName, $data . "\n", FILE_APPEND);
    }
}
