<?php
/**
 * 编辑主页.
 * 
 * @author  Dennis 
 * @version 1.0
 * @package main
 */
	require_once("./MysqliDb.php");
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
	if(!empty($_GET["position"])){
	$position=$_GET["position"];
	$DB->where ("position", $position);
	$index = $DB->getOne ("index");
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
	<form id="addForm" name="addForm" action="indexAction.php" method="post">
    <table>
	<tr><td>位置代号：</td><td><?php
echo $position+1;	?><input type="hidden" id="position" name="position" value="<?echo $position;?>" /></td></tr>
         <tr><td>主页类别：</td>
        <td>
		<input type="hidden" id="typeValue" name="typeValue" value="<?php  if(!empty($index['index_type'])){echo $index['index_type']; }?>">
		<select id="index_type" name="index_type" value=""> 
			<option value="1">首页</option>
			<option value="2">优惠</option>
		</select></td>
        </tr>
		 <tr><td>展示图片地址</td>
        <td><input type="text" class="pic_url" name="pic_url" id="pic_url" value="<?php if(!empty($index['pic_url'])){echo $index['pic_url'];} ?>"/></td>
        </tr>
		 <tr><td>链接：</td>
        <td><input type="text" class="src" id="src" name="src" value="<?php if(!empty($index['src'])){echo $index['src'];} ?>"/></td>
        </tr>
		 <tr><td>绑定标题：</td>
        <td>
		<input type="hidden" id="details_text" name="details_text" value="<?php
		if($position=="2"||$position=="3"){
		$DB->where ("v_id", $index['details_id']);
	$details_text = $DB->getOne ("video");
	}else{
		$DB->where ("id", $index['details_id']);
	$details_text = $DB->getOne ("activity");
	}
		echo $details_text["title"];
		?>"/>
		<input type="hidden" id="details_id_value" name="details_id_value" value="<?php if(!empty($index['details_id'])){echo $index['details_id'];} ?>"/>
		<select id="details_id" name="details_id" value="" >
			 <option value="<?php
			echo $index['details_id'];?>"><?php
			 echo $details_text["title"]?></option>
		</select>
		</td>
        </tr>
		<tr><td><input type="button" name="add" value="确定" onclick="insertDate();" /><input type="button" name="back" value="返回" onclick="goback();" /></td></tr>
    </table>
	</form>
		<script>
		 $(document).ready(function () {
            if ($("#typeValue").val() != "") {
                $("#index_type").val($("#typeValue").val());
            }
			changeValue();
        });

		var url="indexAction.php";
		function insertDate(){
			var position=$('#position').val();
			var index_type=$('#index_type').val();
			var src=$('#src').val();
			var pic_url=$('#pic_url').val();
			var details_id=$('#details_id').val();
			$.ajax({
		  "type":"post",
		   "url":url,
		   "data":{"position":position,"index_type":index_type,"src":src,"pic_url":pic_url,"details_id":details_id},
		   "success":function(){
						$.Show("保存成功", 1);
                     //  window.location.href="indexMgr.php";
					},
		   "error":function(){},
		  "complete":function(){}
		});
		}
		function goback(){
			window.location.href="indexMgr.php";
		}
		function changeValue(){
			var details_type="";
		var position=$('#position').val();
		if(position=="2"||position=="3"){
		details_type="2";
		}else{
		details_type="1";
		}
		$.ajax({
		  "type":"post",
		   "url":"bannerAction.php",
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

			if ($("details_id_value").val() != "") {
                $("#details_id").val($("#details_id_value").val());
            }
		  },
		   "error":function(){},
		  "complete":function(){}
		});
		
	}
	   </script>
	</body>
</html>