<?php
/**
 * index管理action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */
	require_once("./MysqliDb.php");
	require_once ("sqlDb.php");
		$position=$_POST["position"];
		$index_type=$_POST["index_type"];
		$src=$_POST["src"];
		$pic_url=$_POST["pic_url"];
		$details_id=$_POST["details_id"];
			$data=Array(
				  'index_type' => $index_type,
				 'pic_url' => $pic_url,
				 'src' => $src,
				 'details_id' => $details_id,
				);
			$DB->where ('position', $position);
			$DB->update ('index', $data);
?>