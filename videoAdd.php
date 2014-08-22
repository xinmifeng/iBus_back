<?php
/**
 * 新增视频.
 * 
 * @author  Dennis 
 * @version 1.0
 * @package main
 */
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
	if(!empty($_GET["v_id"])){
	$v_id=$_GET["v_id"];
	$DB->where ("v_id", $v_id);
	$video = $DB->getOne ("video");
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
	<form id="addForm" name="addForm" action="videoAction.php" method="post">
    <table>
        <tr><td>标题：</td>
        <td><input type="hidden" id="sign" name="sign" /><input type="hidden" id="v_id" class="v_id" name="v_id" value="<?php
       if(!empty($v_id)){ echo $v_id; }?>" /><input type="text" class="title" id="title" name="title" value="<?php  if(!empty($video['title'])){echo $video['title']; }?>" /></td>
        </tr>
		<tr><td>视频名称：</td>
        <td><input type="select" class="v_name" id="v_name" name="v_name" value="<?php if(!empty($video['v_name'])){echo $video['v_name']; }?>" /></td>
        </tr>
		 <tr><td>视频所属分类：</td>
        <td>
		<select id="type_id" name="type_id" value="<?php if(!empty($video['type_id'])){echo $video['type_id'];} ?>" >
			  <?php 
			  if(!empty($video['type_id'])){
			  ?>
			  <option value="<?php echo $video['type_id'] ?>"><?php
			 $DB->where ("type_id", $video['type_id']);
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
		 <tr><td>展示图片地址</td>
        <td><input type="text" class="pic_url" name="pic_url" id="pic_url" value="<?php if(!empty($video['pic_url'])){echo $video['pic_url'];} ?>"/></td>
        </tr>
		 <tr><td>视频上传：</td>
        <td><input type="text" class="address" name="address" id="address" value="<?php if(!empty($video['address'])){echo $video['address'];} ?>"/></td>
        </tr>
		 <tr><td>时长：</td>
        <td><input type="text" class="length" id="length" name="length" value="<?php if(!empty($video['length'])){echo $video['length'];} ?>"/></td>
        </tr>
		<tr><td>排序值</td>
            <td><input type="text" class="OrderID" id="order_id" name="order_id" value="<?php
           if(!empty($video['order_id'])){
		   echo $video['order_id'];
		   }else{
            $maxOrderID=$DB->getOne("video","max(order_id) as maxID");
			echo $maxOrderID['maxID']+10;
		}
			?>" /></td>
        </tr>
		<tr><td><input type="button" name="add" value="确定" onclick="insertDate();" /><input type="button" name="back" value="返回" onclick="goback();" /></td></tr>
    </table>
	</form>
		<script>
		var url="videoAction.php";
		function insertDate(){
			
			var type_id=$('#type_id').val();
			var v_id=$('#v_id').val();
			var title=$('#title').val();
			var v_name=$('#v_name').val();
			var pic_url=$('#pic_url').val();
			var address=$('#address').val();
			var length=$('#length').val();
			var order_id=$('#order_id').val();
			$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"type_id":type_id,"v_id":v_id,"title":title,"v_name":v_name,"pic_url":pic_url,"address":address,"length":length,"order_id":order_id,"sign":"insert"},
		   "success":function(){
						// $.Show("保存成功", 1);
                       window.location.href="videoList.php";
					},
		   "error":function(){},
		  "complete":function(){}
		});
		}
		function goback(){
			window.location.href="videoList.php";
		}
	   </script>
	</body>
</html>