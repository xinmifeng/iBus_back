<?php
//$DB = new Mysqlidb('192.168.1.106', 'root', 'Roberter@1234', 'iBus');
$DB = new Mysqlidb('192.168.1.101', 'root', 'root', 'busfree');
//$DB = new Mysqlidb('localhost', 'newbee', 'newbee', 'busfree');
//$DB = new Mysqlidb('hdm-126.hichina.com', 'hdm1260830', '123qwe123', 'hdm1260830_db');
if(!$DB) die("Database error");

$prefix = 'bee_';
$DB->setPrefix($prefix);

?>
