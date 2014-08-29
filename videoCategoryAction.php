<?php
/**
 * 视频分类管理action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */

	require_once("./MysqliDb.php");
 require_once ("sqlDb.php");
 $createDate=$DB->now();
 $sign = $_POST["sign"];
switch ($sign) {
    case "insert": //新增视频分类
		$typeName=$_POST["typeName"];
		$orderID=$_POST["orderID"];
		if(!empty($_POST["typeID"])){//如果存在ID，就修改记录
			$typeID=$_POST["typeID"];
			$data=Array(
				 'type_name' => $typeName,
	//			 'create_date' => $createDate, //修改创建时间
				 'order_id' => $orderID
				);
			$DB->where ('type_id', $typeID);
			$DB->update ('video_type', $data);
//修改 放入历史记录表-----------------------------------------------
while(list($k,$v) = each($data)){ 
	if($v!=""){
		$arr[$k]=$v;
	}
} 
$sqlString="update bee_video_type set ";
while(list($k,$v) = each($arr)){ 
	$keyvalue=$k."='".$v."',";
	$sqlString.=$keyvalue;
} 
$sqlString=substr($sqlString,0,-1);
$sqlString.=" where type_id=".$typeID;
$jsonVlue=json_encode($arr);
//	"{'";
//while(list($k,$v) = each($arr)){ 
//		$jsonVlue.=$k."':'".$v."',";
//} 
//	$jsonVlue=substr($jsonVlue,0,-1);
//	$jsonVlue.="}";
		$hisData=Array(						
			'table_name' => 'bee_video_type',
			'action' => 'upd',
			'cost' => '',
			'modified' => $jsonVlue,
			'modified_sql' => $sqlString,
			'table_name' => 'bee_video_type',
			'action_time' => $createDate,
			'export_time' => ""
			);
			$DB->insert('history',$hisData);
}else{
			$data=Array(
			 'type_name' => $typeName,
			 'create_date' =>  $createDate,
			 'order_id' => $orderID
			);
			$DB->insert('video_type',$data);
//新增 放入历史记录表-----------------------------------------------
		$jsonVlue="{'type_name':'".$typeName."',''create_date:'".$DB->now()."','order_id','".$orderID."'}";
		$sqlString="insert into video_type(type_name,order_id,create_date) values('".$typeName."','".$orderID."','".$DB->now()."')";
		$hisData=Array(						
			'table_name' => 'bee_video_type',
			'action' => 'add',
			'cost' => '',
			'modified' => $jsonVlue,
			'modified_sql' => $sqlString,
			'action_time' => $createDate,
			'export_time' => "",
			);
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
		$count=$DB->delete('video_type');
        echo $count;
		break;
}

?>