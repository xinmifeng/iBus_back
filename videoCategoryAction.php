<?php
/**
 * ��Ƶ�������action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */


 require_once ("sqlDb.php");
 $sign = $_POST["sign"];
switch ($sign) {
    case "insert": //������Ƶ����
		$typeName=$_POST["typeName"];
		$orderID=$_POST["orderID"];
		if(!empty($_POST["typeID"])){//�������ID�����޸ļ�¼
			$typeID=$_POST["typeID"];
			$data=Array(
				 'type_name' => $typeName,
	//			 'create_date' => $DB->now(), //�޸Ĵ���ʱ��
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
	case "toUpdate": //�����޸���Ƶ����
	    $typeID=$_POST["tid"];
		$DB->where ("type_id", $typeID);
		$data = $DB->getOne ("video_type");
		header("Content-type: application/json"); 
		echo json_encode($data);
	    break;

	case "delete": //ɾ����Ƶ����
		$tIDs=$_POST["tids"];
		$DB->where('type_id', $tIDs, 'IN');
		$DB->delete('video_type');
		break;
}

?>