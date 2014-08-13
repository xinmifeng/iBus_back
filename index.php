<?php
	require_once("doAccess.php");
?>
<!Doctype>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>管理后台</title>
	<style>
		html,body{width:100%;height:100%;}
	</style>
</head>
	<frameset rows="64,*"  frameborder="NO" border="0" framespacing="0">
		<frame src="admin_top.php" noresize="noresize" frameborder="NO" name="topFrame" 
				scrolling="no" marginwidth="0" marginheight="0" target="main" />
	<frameset cols="200,*" id="frame">
		<frame src="left.php" name="leftFrame" noresize="noresize" marginwidth="0" 
				marginheight="0" frameborder="0" scrolling="no" target="main" />
		<frame src="right.php" name="main" marginwidth="0" marginheight="0" 
				frameborder="0" scrolling="auto" target="_self" />
	</frameset>
	<noframes>
		<body></body>
	</noframes>
</html>
