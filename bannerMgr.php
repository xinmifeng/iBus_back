<?php
/**
 * banner管理.
 * 
 * @author  Dennis 
 * @version 1.0
 * @package main
 */
	require_once("./MysqliDb.php");
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
	$i=1;
	$DB->orderBy("order_id","asc");
	$result = $DB->get("banner");
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
				<td colspan="10" align="center">banner管理</td>
			</tr>
			<tr>
			<td class="STYLE1">
               <div align="center"><input type="checkbox" />全选</div>
            </td>
			<td class="tab_header">序号</td>
			<td class="tab_header">标题</td>
			<td class="tab_header">所属类别</td>
			<td class="tab_header">图片地址</td>
			<td class="tab_header">链接</td>
			<td class="tab_header">绑定类型</td>
			<td class="tab_header">绑定标题</td>
			<td class="tab_header">排序值</td>
			<td class="tab_header">创建时间</td>
			</tr>
<?
     foreach ($result as $rs)  //循环
     {
       ?>
			<tr> 
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF">
        <div align="center">
            <input type="checkbox" name="checkboxName" value="<?php echo $rs['id'] ?>"/>
        </div>
    </td>	
				<td><input type="hidden" name="id" /><? echo $i ?></td>
				<td><? echo $rs['title']?></td>
				<td><? switch ($rs['type']) {
						case "1": echo "首页";
								 break;
						case "2": echo "视频";
								 break;
						case "3": echo "优惠";
								 break;
						case "4": echo "应用";
								 break;
							}		
					 ?></td>
				<td><? echo $rs['picture_url']?></td>
				<td><? echo $rs['src']?></td>
				<td><? switch ($rs['details_type']) {
						case "1": echo "活动及应用";
								 break;
						case "2": echo "视频";
								 break;
							}		
					 ?></td>
				<td><? echo $rs['details_id']?></td>
				<td><? echo $rs['order_id']?></td>
				<td><? echo $rs['create_date']?></td>
			</tr>
			<? $i++; }?>
			<tr>
			<td colspan="10">
				<input type="button" name="add" value="新增" onclick="javascript:to_addPage();" />
				<input type="button" name="update" value="修改" onclick="to_updatePage();" />
				<input type="button" name="del" value="删除" onclick="to_delete();"/>
			</td>
			</tr>
		</table>
		<script>
		var url = "bannerAction.php";
		 //弹出添加页面
        function to_addPage(){
			window.location.href="bannerAddOrUpdate.php";
        }
		//弹出修改页面
		function to_updatePage(){
		 var boxes = document.getElementsByName("checkboxName");  
			 var groupTypeId = new Array(); 
			 var h=0;
			 for (var g = 0; g < boxes.length; g++)  
			 {  
					 if (boxes[g].checked)  
				 {  
					  groupTypeId[h] = boxes[g].value;  
					  h++;
				 }  
			 }
			 if(groupTypeId.length-1>1){
				  $.Show("只能选择一条记录进行修改", 3);
			 return false;
			 }
//          $.ajax({
//			  "type":"post",
//			   "url":url,
//			   "data":{"vid":groupTypeId[0],"sign":"toUpdate"},
//			   "success":function(){},
//			   "error":function(){},
//			  "complete":function(){}
//		});
	
			window.location.href="videoAdd.php?v_id="+groupTypeId[0];
		}

	function insertDate(el){
		var $table = $(el).closest("table");
		var typeName = $("input.typeName",$table).val();
		var orderID = $("input.typeOrderID",$table).val();
		var typeID = $("input.type_id",$table).val();
		$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"typeName":typeName,"orderID":orderID,"typeID":typeID,"sign":"insert"},
		   "success":function(){
						 $.Show("保存成功", 1);
                        $(".xubox_layer").find("#closebtn").click();
					},
		   "error":function(){},
		  "complete":function(){}
		});
	}

	function to_delete(){
		var msg = "是否确定删除？"; 
if (confirm(msg)==true){ 
 var boxes = document.getElementsByName("checkboxName");  
			 var groupTypeId = new Array(); 
			 var h=0;
			 for (var g = 0; g < boxes.length; g++)  
			 {  
					 if (boxes[g].checked)  
				 {  
					  groupTypeId[h] = boxes[g].value;  
					  h++;
				 }  
			 }
          $.ajax({
			  "type":"post",
			   "url":url,
			   "data":{"tids":groupTypeId,"sign":"delete"},
			   "success":function(data){
			  window.location.href="bannerMgr.php";
			  },
			   "error":function(){},
			  "complete":function(){}
		});
}else{ 
return false; 
} 
	}
	   </script>
	</body>
</html>