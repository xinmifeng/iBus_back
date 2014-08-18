<?php
ob_start();
header('Content-Type: text/html;charset=utf-8');
/*
	此文件只负责将数据表中文件上传进度更新为100%
		向数据库添加新记录在 ajax_create_fid.php 文件中处理
	如果服务器不存在此文件，则添加一条记录，百分比为100%
	如果服务器已存在相同文件，则将文件上传百分比更新为100%
*/
require('HttpUploaderDB.php');

$md5 = $_GET["md5"];
$uid = $_GET["uid"];
$fid = $_GET["fid"];
$callback = $_GET["callback"];
$ret = $callback . "(0)";

//md5和uid不能为空
if ( strlen($fid) > 0 
	&& strlen($uid) > 0)
{
	$db = new HttpUploaderDB();
	$db->UpdateComplete($md5);
	$ret = $callback . "(1)";
}

//返回查询结果
echo $ret;
header('Content-Length: ' . ob_get_length());
?>