<?php
/**
 * ��Ƶ�������action 
 * 
 * @author  dennis 
 * @version 1.0
 * @package main
 */

 //������Ƶ����
	$typeName=$_POST["typeName"];
	$orderID=$_POST["orderID"];
	$addForm=Array('video_type'=>
	Array('typeName' => $typeName,
	'orderID' => $orderID
	)
	)
	foreach($addForm as $name => $addForms){
		foreach($addForms as $a){
			$DB->insert($name, $a);
			 if ($id)`
            $a['id'] = $id;
        else {
            echo "failed to insert: ".$db->getLastQuery() ."\n". $db->getLastError();
        }
		}
	}


?>