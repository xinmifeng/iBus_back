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
	$DB->orderBy("position","asc");
	$result = $DB->get("index");
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
			<table  border="1">
			<tr>
				<td colspan="12" align="center">视频管理</td>
			</tr>
			<tr>
			<td class="tab_header">位置</td>
			<td class="tab_header">所属类别</td>
			<td class="tab_header">图片地址</td>
			<td class="tab_header">链接</td>
			<td class="tab_header">绑定标题</td>
			<td class="tab_header">操作</td>
			</tr>
<?
     foreach ($result as $rs)  //循环
     {
       ?>
			<tr> 
				<td><input type="hidden" id="index_id" name="index_id" /><? echo "位置".$rs['position']+1 ?></td>
				<td><? switch ($rs['index_type']) {
						case "1": echo "首页";
								 break;
						case "2": echo "优惠";
								 break;
							}		
					 ?></td>
				<td><? echo $rs['pic_url']?></td>
				<td><? echo $rs['src']?></td>
				<td><?php if($rs['position']=="2"||$rs['position']=="3"){
			$DB->where ("v_id", $rs['details_id']);
		$details_text = $DB->getOne ("video");
	}else{
		$DB->where ("id", $rs['details_id']);
		$details_text = $DB->getOne ("activity");
	}
		echo $details_text["title"]; 
						 ?></td>
			<td><input type="button" value="编辑" onclick="to_page('<? echo $rs['position'];?>')" /></td>
			</tr>
			<? }?>
		</table>
	<script>
	function to_page(pos){
	window.location.href="indexEdit.php?position="+pos;
	}
	</script>
	</body>
 </html>