<?php
	session_start();
	require_once("./sqlDb.php");
	if(!isset($_GET["action"])){
		echo json_encode(array());
		exit(0);
	}
	$action = $_GET["action"];
	$data=array();
	switch($action){
		case "list":
			for($i=0;$i<10;$i++){
				array_push($data,array(
					"name"=>"video".$i,
					"src"=>"src".$i
				));
			}
		break;
	}
	echo json_encode($data);
?>
