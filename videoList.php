<?php
	require_once("doAccess.php");
?>
<!Doctype>
<html>
<head>
<title></title>
<link ref="sytlesheet" href="./bower_components/jquery-flexigrid/css/flexigrid.css" />
<script src="./bower_components/jquery/jquery.min.js"></script>
<script src="./bower_components/jquery-flexigrid/js/flexigrid.js"></script>
</head>
<body>
	<div id="videoListDiv">
		<table class="vlistTb">
		</table>
	</div>
</body>
</html>
<script>
	$(".vlistTb").flexigrid({
		url:"videoAction.php",
		dataType:'json',
		colMode:[
			{
			display:'name',
			name:'name',
			width:90,
			sortable:true,
			align:'center'
			},
			{
				display:'src',
				name:'src',
				width:120,
				sortable:true,
				align:'center'
			}
		]
	});
</script>
