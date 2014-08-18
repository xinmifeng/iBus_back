<?php 
	session_start();
	require_once("./sqlDb.php");
	$error_info="";
	if(!empty($_POST["password"])){
	
	}else{
	 $error_info="请输入原始密码";
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<table>
<tr><td colspan="2" align="center">修改密码</td></tr>
<tr><td>原始密码：</td><td><input name="password" type="text" /></td></tr>
<tr><td>新密码：</td><td><input name="newpsd" type="text" /></td></tr>
<tr><td colspan="2" align="center"> <input type="submit" value="提交" /></td></tr>
<tr><td colspan="2"><p><?php echo $error_info; ?><p></td></tr>
</table>
</body>
</html>