<?php
	session_start();
	require_once("./sqlDb.php");
	if(!isset($_GET["action"])){
		echo json_encode(array());
		exit(0);
	}
	$action = $_GET["action"];
	function getFlexData($page,$total,$rows){
		$data = array(
			"page"=>$page,
			"total"=>$total,
			"rows"=>array()
		);
		foreach($rows as $row){
			array_push($data["rows"],array(
				"id"=>$row["id"],
				"cell"=>$row
			));
		}
		return $data;
	}
	$queryData = array();
	switch($action){
		case "list":
			for($i=0;$i<10;$i++){
				array_push($queryData,array(
					"id"=>$i,
					"name"=>"video".$i,
					"src"=>"src".$i
				));
			}
		break;
	}
    header("Content-type: application/json");
	$redata = getFlexData("1",10,$queryData);
	echo json_encode($redata);
?>
