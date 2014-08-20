<?php
/**
 * 视频分类管理action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */

 //新增视频分类
 require_once ("sqlDb.php");
	$typeName=$_POST["typeName"];
	$orderID=$_POST["orderID"];
	$data=Array(
	 'type_name' => $typeName,
	 'create_date' => $DB->now(),
	 'order_id' => $orderID
	);
	$DB->insert('video_type',$data);
?>