<?php
/**
 * ��Ƶ�������action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */

 //������Ƶ����
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