<?php
	session_start();
	require_once("./sqlDb.php");
	$data=array();
	function returnData(){
		echo json_decode($data);
		exit(0);
	}
	if(is_null($_POST["action"])){
	}
	if(empty($_POST["action"])){
		returnData();	
	}
	$action = $_POST["action"];
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
	returnData();
?>
