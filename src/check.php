<?php
class check
{
    protected $logger;
    protected $path;

    public function __construct($path = null)
    {
        $this->logger = new logger($path);
        $this->path = $path;
    }

    public function toHandle()
    {
        $list = $this->getDir($this->path);
        foreach ($list as $item) {
            $this->check($item);
        }
    }

    public function check($file)
    {
        $list = $this->getDir(__DIR__ . DIRECTORY_SEPARATOR . 'type');

        try {
            foreach ($list as $item) {
                require_once $item;
                $str = explode('.', $item);
                $classPath = $str[0];
                $array = explode('/', $classPath);
                $className = $array[count($array) - 1];
                $instance = new $className;
                $res = $instance->run($file);
                if (!$res['status']) {
                    $this->log($file . ':' . $res['msg']);
                    break;
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDir($path)
    {
        //判断目录是否为空
        if (!file_exists($path)) {
            return [];
        }

        $files = scandir($path);
        $fileItem = [];
        foreach ($files as $v) {
            $newPath = $path . DIRECTORY_SEPARATOR . $v;
            if (is_dir($newPath) && $v != '.' && $v != '..') {
                $fileItem = array_merge($fileItem, $this->getDir($newPath));
            } else if (is_file($newPath)) {
                $fileItem[] = $newPath;
            }
        }

        return $fileItem;
    }
    protected function log($data)
    {
        echo $data . "\n";
        $this->logger->log($data);
    }
}
