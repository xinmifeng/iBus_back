<?php
	require_once("doAccess.php");
?>
<!Doctype>
<html>
<head>
<title></title>
<link rel="stylesheet" href="./bower_components/jquery-flexigrid/css/flexigrid.css" />
<script src="./bower_components/jquery/jquery.min.js"></script>
<script src="./bower_components/jquery-flexigrid/js/flexigrid.js"></script>
</head>
<body>
	<div id="videoListDiv">
		<table class="vlistTb"></table>
	</div>
</body>
</html>
<script>
	$(".vlistTb").flexigrid({
		url:"videoAction.php?action=list",
		dataType:'json',
		colModel:[
			{
				display:'id',
				name:'id',
				width:90,
				sortable:true,
				align:'center'
			},
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
		],
		sortname : "iso",
		sortorder : "asc",
		usepager : true,
		title : 'Employees',
		useRp : true,
		rp : 10,
		showTableToggleBtn : true,
		width : 750,
		height : 200
	});
</script>
