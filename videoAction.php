<?php
/**
 * ��Ƶ����action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */

 require_once ("sqlDb.php");
 $sign = $_POST["sign"];
switch ($sign) {
    case "insert": //������Ƶ��Ϣ
		$type_id=$_POST["type_id"];
		$title=$_POST["title"];
		$pic_url=$_POST["pic_url"];
		$v_name=$_POST["v_name"];
		$address=$_POST["address"];
		$length=$_POST["length"];
		$orderID=$_POST["order_id"];
		if(!empty($_POST["v_id"])){//�������ID�����޸ļ�¼
			$v_id=$_POST["v_id"];
			$data=Array(
				  'type_id' => $type_id,
				 'title' => $title,
				 'pic_url' => $pic_url,
				 'v_name' => $v_name,
				 'address' => $address,
				 'length' => $length,
	//			 'create_date' => $DB->now(), //�޸Ĵ���ʱ��
				 'order_id' => $orderID
				);
			$DB->where ('v_id', $v_id);
			$DB->update ('video', $data);
		}else{
			$data=Array(
				 'type_id' => $type_id,
				 'title' => $title,
				 'pic_url' => $pic_url,
				 'v_name' => $v_name,
				 'address' => $address,
				 'length' => $length,
				 'create_date' => $DB->now(),
				 'order_id' => $orderID
			);
			$DB->insert('video',$data);
		}
		// header('Location:videoList.php');
		 break;

	case "delete": //ɾ����Ƶ����
		$tIDs=$_POST["tids"];
		$DB->where('v_id', $tIDs, 'IN');
		$DB->delete('video');
		break;
}

?>