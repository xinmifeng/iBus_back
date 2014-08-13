<?php
	if(!empty($_GET["username"]) && !empty($_GET["pwd"])){
		echo $_GET["username"].$_GET["pwd"];
	}
	else{
		echo 0;
	}
?>
