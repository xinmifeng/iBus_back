<?php
/**
 * 主页管理.
 * 
 * @author  Dennis 
 * @version 1.0
 * @package main
 */
	require_once("./MysqliDb.php");
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
	<head>
	<script src="bower_components/jquery/jquery.js"></script>
	<script src="js/layer/layer/layer.min.js"></script>
	<script src="js/Layerutility.js"></script>
	</head>
	<body>
		<table algn="center">
		<tr>
		<td><input type="button" width="100px" height="50" value="编辑位置1" onclick="to_page('0');" /></td>
		<td><input type="button" width="100px" height="50" value="编辑位置2" onclick="to_page('1');" /></td>
		</tr>
		<tr>
		<td><input type="button" width="100px" height="50" value="编辑位置3(视频)" onclick="to_page('2');" /></td>
		<td><input type="button" width="100px" height="50" value="编辑位置4(视频)" onclick="to_page('3');" /></td>
		</tr>
		<tr>
		<td><input type="button" width="100px" height="50" value="编辑位置5" onclick="to_page('4');" /></td>
		<td><input type="button" width="100px" height="50" value="编辑位置6" onclick="to_page('5');" /></td>
		</tr>
		<tr>
		<td><input type="button" width="100px" height="50" value="编辑位置7" onclick="to_page('6');" /></td>
		<td><input type="button" width="100px" height="50" value="编辑位置8" onclick="to_page('7');" /></td>
		</tr>
		<tr>
		<td><input type="button" width="100px" height="50" value="编辑位置9" onclick="to_page('8');" /></td>
		<td><input type="button" width="100px" height="50" value="编辑位置10" onclick="to_page('9');" /></td>
		</tr>
		<tr>
		<td><input type="button" width="100px" height="50" value="编辑位置11" onclick="to_page('10');" /></td>
		<td><input type="button" width="100px" height="50" value="编辑位置12" onclick="to_page('11');" /></td>
		</tr>
		</table>
	<script>
	function to_page(pos){
	window.location.href="indexEdit.php?position="+pos;
	}
	</script>
	</body>

</html>