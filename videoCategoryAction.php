<?php
/**
 * 视频分类管理action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */


 require_once ("sqlDb.php");
 $sign = $_POST["sign"];
switch ($sign) {
    case "insert": //新增视频分类
		$typeName=$_POST["typeName"];
		$orderID=$_POST["orderID"];
		if(!empty($_POST["typeID"])){//如果存在ID，就修改记录
			$typeID=$_POST["typeID"];
			$data=Array(
				 'type_name' => $typeName,
	//			 'create_date' => $DB->now(), //修改创建时间
				 'order_id' => $orderID
				);
			$DB->where ('type_id', $typeID);
			$DB->update ('video_type', $data);
		}else{
			$data=Array(
			 'type_name' => $typeName,
			 'create_date' => $DB->now(),
			 'order_id' => $orderID
			);
			$DB->insert('video_type',$data);
		}
		 break;
	case "toUpdate": //跳到修改视频分类
	    $typeID=$_POST["tid"];
		$DB->where ("type_id", $typeID);
		$data = $DB->getOne ("video_type");
		header("Content-type: application/json"); 
		echo json_encode($data);
	    break;

	case "delete": //删除视频分类
		$tIDs=$_POST["tids"];
		$DB->where('type_id', $tIDs, 'IN');
		$DB->delete('video_type');
		break;
}

?>