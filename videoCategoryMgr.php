<?php
/**
 * 视频管理.
 * 
 * @author  Dennis 
 * @version 1.0
 * @package main
 */
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
	$i=1;
//	mysql_select_db("busfree", $DB);
//$result = mysql_query("SELECT * FROM video_type");
$result = $DB->get("video_type");
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
	<head></head>
	<body>
		<table border="1">
			<tr>
				<td colspan="4" align="center">视频分类管理</td>
			</tr>
			<tr>
			<td>序号</td>
			<td>类别名称</td>
			<td>排序值</td>
			<td>创建时间</td>
			</tr>
<?
     foreach ($result as $rs)  //循环
     {
       ?>
			<tr>
				<td><input type="hidden" name="type_id" /><? echo $i ?></td>
				<td><? echo $rs['type_name']?></td>
				<td><? echo $rs['order_id']?></td>
				<td><? echo $rs['create_date']?></td>
			</tr>
			<? $i++; }?>
			<tr>
			<td colspan="4">
				<input type="button" name="add" value="新增" onclick="to_addPage();" />
				<input type="button" name="update" value="修改"/>
				<input type="button" name="del" value="删除"/>
			</td>
			</tr>
		</table>
		<script type="javascript">
		function to_addPage(){
	   window.showModalDialog('addVideoCategory.php',window,'scroll:0;status:0;help:1;resizable:1;dialogWidth:480px;dialogHeight:320px');
	   }
	   </script>
	</body>
</html>