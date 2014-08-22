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
	<body>
	<form id="addForm" name="addForm" action="bannerAction.php" method="post">
    <table>
        <tr><td>标题：</td>
        <td><input type="hidden" id="sign" name="sign" /><input type="hidden" id="id" class="id" name="id" value="<?php
       if(!empty($id)){ echo $id; }?>" /><input type="text" class="title" id="title" name="title" value="<?php  if(!empty($banner['title'])){echo $banner['title']; }?>" /></td>
        </tr>
		 <tr><td>视频所属分类：</td>
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
		 <tr><td>绑定标题：</td>
        <td>
		<select id="type" name="type" value="<?php if(!empty($video['type'])){echo $video['type'];} ?>" >
			  <?php 
			  if(!empty($video['type'])){
			  ?>
			  <option value="<?php echo $video['type'] ?>"><?php
			 $DB->where ("type_id", $video['type']);
					$vType = $DB->getOne ("video_type");
					echo $vType["type_name"];
				?></option>
			  <?php
			  }
			  $DB->orderBy("order_id","asc");
				$result = $DB->get("video_type");
			  foreach ($result as $v)
			{?>
				<option value="<?=$v['type_id']?>"><?=$v['type_name']?></option>
			 <?php
			 }
			 ?>
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
			
			var type_id=$('#type_id').val();
			var id=$('#id').val();
			var title=$('#title').val();
			var v_name=$('#v_name').val();
			var pic_url=$('#pic_url').val();
			var address=$('#address').val();
			var length=$('#length').val();
			var order_id=$('#order_id').val();
			$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"type_id":type_id,"id":id,"title":title,"v_name":v_name,"pic_url":pic_url,"address":address,"length":length,"order_id":order_id,"sign":"insert"},
		   "success":function(){
						// $.Show("保存成功", 1);
                       window.location.href="bannerList.php";
					},
		   "error":function(){},
		  "complete":function(){}
		});
		}
		function goback(){
			window.location.href="bannerList.php";
		}
	function changeValue(){
		var type=$("#type").val();
		$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"type":type,"sign":"select"},
		   "success":function(){
				var e = document.getElementById("type"); 
				e. options= new Option("文本","值") ; 
		  },
		   "error":function(){},
		  "complete":function(){}
		});
		
	}
	   </script>
	</body>
</html>