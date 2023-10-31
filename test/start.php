<?php

require_once __DIR__ . '/../src/Autoloader.php';
Autoloader::register();

set_time_limit(0); 
$options = getopt('', ['path:']);
$path = $options['path'];
$check = new check($path);
$res = $check->toHandle();
echo $res;