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
	$DB->orderBy("order_id","asc");
	$result = $DB->get("video_type");
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
	<div style="display:none" id="DIV_Event">
	<form name="addForm" action="videoCategoryAction.php" method="post">
    <table>
        <tr><td>视频分类名称：</td>
        <td><input type="text" class="typeName" name="type_name" /></td>
        </tr>
		<tr><td>排序值</td>
            <td><input type="text" class="typeOrderID" name="type_order_id" value="<?php
            $maxOrderID=$DB->getOne("video_type","max(order_id) as maxID");
				echo $maxOrderID['maxID'];
			?>" /></td>
        </tr>
		<tr><td><input type="button" name="add" value="添加" onclick="insertDate(this);" /><input type="button" id="closebtn"  value="关闭" /></td></tr>
    </table>
	</form>
</div>
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
				<input type="button" name="add" value="新增" onclick="javascript:to_addPage();" />
				<input type="button" name="update" value="修改"/>
				<input type="button" name="del" value="删除"/>
			</td>
			</tr>
		</table>
		<script>
		 //弹出添加页面
        function to_addPage(){
            var htm=$("#DIV_Event").html();
            console.log(htm);
            $.ShowHtmlByForm(htm,"添加视频分类");
        }

	function insertDate(el){
		var url = "videoCategoryAction.php";
		var $table = $(el).closest("table");
		var typeName = $("input.typeName",$table).val();
		var orderID = $("input.typeOrderID",$table).val();
		$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"typeName":typeName,"orderID":orderID},
		   "success":function(){
						$.Show("添加成功",1);
						$("#btnclose").click();	
					
					},
		   "error":function(){alert(url)},
		  "complete":function(){}
		});
	}
	   </script>
	</body>
</html>