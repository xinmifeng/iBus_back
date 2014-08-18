<?php 
	require_once("./sqlDb.php");
	require_once("./doAccess.php");
	$error_info="";
//	if(!empty($_GET["error_info"])){
//	$error_info=$_GET["error_info"];
//	};
		
if(!empty($_POST["flag"])){
	if(!empty($_POST["password"])){
		if(!empty($_POST["newpsd"])&&!empty($_POST["newpsd2"])){
			if($_POST["newpsd"]!=$_POST["newpsd2"]){
			 echo "<script>";
  echo  "alert('两次密码填写不一致，请重新填写');window.location.href=window.location.href;";
  echo "</script>";
			exit;
			}
		$password=$_POST["password"];
		$newpsd=$_POST["newpsd"];
			$DB->where("id",$admin['id'])
				->where("password",md5($password));
			$DB->get("user");
						if($DB->count<1){
						 echo "<script>";
  echo  "alert('密码错误，请重新输入');window.location.href=window.location.href;";
  echo "</script>";
						exit;
					}else{
			$upData = Array (
			'password' => md5($newpsd),
			);
		$DB->where ("id",$admin['id']);
			$cnt = $DB->update("system_user", $upData);
			if ($DB->count != 1) {
				$error_info="修改失败";
			}else{
				 echo "<script>";
  echo  "alert('修改成功！');window.location.href=window.location.href;";
  echo "</script>";
			}
			}
		}else{
			$error_info="请填写新密码和确认密码";
		}
	}else{
	 $error_info="请输入原始密码";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="javascript" src="bower_components\jquery\jquery.js"></script>
</head>
<body>
<form name="myForm" action="updatePassword.php" method="post" onsubmit="checkForm();">
<table>
	<tr><td colspan="2" align="center">修改密码</td></tr>
	<tr><td>原始密码：</td><td><input name="password" type="password"  maxlength="20" /></td></tr>
	<tr><td>新密码：</td><td><input name="newpsd" type="password"  maxlength="20" /></td></tr>
	<tr><td>确认新密码：</td><td><input name="newpsd2" type="password"  maxlength="20" /></td></tr>
	<tr><td colspan="2" align="center"><input type="hidden" name="flag" value="1" />
	<input name="submit" type="submit" value="提交"  /></td></tr>
	<tr><td colspan="2"><p>
	<?php
	echo $error_info; ?><p></td></tr>
</table>
</form>
<script type="javascript">
function checkForm(){
if(document.getElementByID("newpsd2")==null||document.getElementByID("newpsd2")==""){
alert()
}
if(document.getElementByID("newpsd").value!=document.getElementByID("newpsd2")){
alert("两次密码输入不一致");
return false;
}
}
</script>
</body>
</html>