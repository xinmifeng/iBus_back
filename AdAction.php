<?php
require_once("./MysqliDb.php");
require_once("sqlDb.php");

$id = $_POST["id"];
$data = $_POST["UData"];
$fileName=$_POST["Utype"];
$sign = $_POST["sign"];
$DB->where('index_id', $id);
$UpCount = $DB->update('index', $data);
echo $sign . "," . $fileName;
?>