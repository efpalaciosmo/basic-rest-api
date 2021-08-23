<?php
$dir_name = dirname(__FILE__);
$dir_conf = $dir_name . "/" . "config.json";
$json_data = file_get_contents($dir_conf);
$array = json_decode($json_data, true);

print_r($array['server']);