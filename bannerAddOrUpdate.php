<?php
/**
 * 新增或者修改banner.
 * 
 * @author  Dennis 
 * @version 1.0
 * @package main
 */
 require_once("./MysqliDb.php");
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
	if(!empty($_GET["id"])){
	$id=$_GET["id"];
	$DB->where ("id", $id);
	$banner = $DB->getOne ("banner");
	}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
	<head>
	<script src="bower_components/jquery/jquery.js"></script>
	<script src="js/layer/layer/layer.min.js"></script>
	<script src="js/Layerutility.js"></script>
	</head>
	<body onload="changeValue();">
	<form id="addForm" name="addForm" action="bannerAction.php" method="post">
    <table>
        <tr><td>标题：</td>
        <td><input type="hidden" id="sign" name="sign" /><input type="hidden" id="id" class="id" name="id" value="<?php
       if(!empty($id)){ echo $id; }?>" /><input type="text" class="title" id="title" name="title" value="<?php  if(!empty($banner['title'])){echo $banner['title']; }?>" /></td>
        </tr>
		 <tr><td>分类：</td>
        <td>
		<select id="type" name="type" onchange="changeValue();" value="<?php  if(!empty($banner['type'])){echo $banner['type']; }?>"> 
			<option value="1">首页</option>
			<option value="2">视频</option>
			<option value="3">优惠</option>
			<option value="4">应用</option>
		</select>
		</td>
        </tr>
		 <tr><td>展示图片地址</td>
        <td><input type="text" class="picture_url" name="picture_url" id="picture_url" value="<?php if(!empty($banner['picture_url'])){echo $banner['picture_url'];} ?>"/></td>
        </tr>
		 <tr><td>链接：</td>
        <td><input type="text" class="src" name="src" id="src" value="<?php if(!empty($banner['src'])){echo $banner['src'];} ?>"/></td>
        </tr>
		<tr><td>绑定分类：</td>
        <td>
		<select id="details_type" name="details_type" onchange="changeValue();" value="<?php  if(!empty($banner['details_type'])){echo $banner['details_type']; }?>"> 
			<option value="1">活动及应用</option>
			<option value="2">视频</option>
		</select>
		</td>
        </tr>
		 <tr><td>绑定标题：</td>
        <td>
		<select id="details_id" name="details_id" value="<?php if(!empty($video['details_id'])){echo $video['details_id'];} ?>" >
			 <option value="">请选择</option>
		</select>
		</td>
        </tr>
		<tr><td>排序值</td>
            <td><input type="text" class="OrderID" id="order_id" name="order_id" value="<?php
           if(!empty($banner['order_id'])){
		   echo $banner['order_id'];
		   }else{
            $maxOrderID=$DB->getOne("banner","max(order_id) as maxID");
			echo $maxOrderID['maxID']+10;
		}
			?>" /></td>
        </tr>
		<tr><td><input type="button" name="add" value="确定" onclick="insertDate();" /><input type="button" name="back" value="返回" onclick="goback();" /></td></tr>
    </table>
	</form>
		<script>
		var url="bannerAction.php";
		function insertDate(){
			
			var type=$('#type').val();
			var id=$('#id').val();
			var title=$('#title').val();
			var src=$('#src').val();
			var picture_url=$('#picture_url').val();
			var details_type=$('#details_type').val();
			var details_id=$('#details_id').val();
			var order_id=$('#order_id').val();
			$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"type":type,"id":id,"title":title,"src":src,"picture_url":picture_url,"details_type":details_type,"details_id":details_id,"order_id":order_id,"sign":"insert"},
		   "success":function(){
						// $.Show("保存成功", 1);
                       window.location.href="bannerMgr.php";
					},
		   "error":function(){},
		  "complete":function(){}
		});
		}
		function goback(){
			window.location.href="bannerMgr.php";
		}
	function changeValue(){
		var details_type=$("#details_type").val();
		$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"details_type":details_type,"sign":"select"},
		   "success":function(dataList){
	var selectbox = document.getElementById("details_id");
	selectbox.length = 0;
	for(var i=0;i<dataList.length;i++){
		var newOption = document.createElement("option");
	newOption.appendChild(document.createTextNode(dataList[i][1]));
	newOption.setAttribute("value", dataList[i][0]);
	selectbox.appendChild(newOption);
	}


//				var e = document.getElementById("details_id"); 
//				alert(dataList.length)
//				for(var i=0;i<dataList.length;i++){
//					e.options= new Option(dataList[i][1],dataList[i][0]); 
//				}
//				
		  },
		   "error":function(){},
		  "complete":function(){}
		});
		
	}
	   </script>
	</body>
</html>