<?php
require_once ("./PHP-MySQLi-Database-Class/MysqliDb.php");
error_reporting(E_ALL);

$db = new Mysqlidb('localhost', 'root', 'Roberter@1234', 'iBus');
if(!$db) die("Database error");

//$prefix = 't_';
//$db->setPrefix($prefix);

$data=Array("name"=>"zhanghaibin",
			"sex"=>0,
			"degree"=>59
);
$id = $db->insert('user',$data);
echo '2';
if(id){
	echo 'success';
}
else{
	echo 'fail';
}
