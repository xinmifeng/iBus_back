<?php
ob_start();
header('Content-type: text/html;charset=utf-8');
/*
	此文件主要功能如下：
		1.在数据库中添加新记录
		2.返回新加记录信息。JSON格式
		3.创建上传目录
	此文件主要在数据库中添加新的记录并返回文件信息
		如果存在则在数据库中添加一条相同记录。返回添加的信息
		如果不存在，则向数据库中添加一条记录。并返回此记录ID
	控件每次计算完文件MD5时都将向信息上传到此文件中
*/
require('HttpUploaderDB.php');
require('HttpUploaderConfig.php');
require('FileResumer.php');

$md5 		= $_GET["md5"];
$uid 		= $_GET["uid"];
$fileLength	= $_GET["fileLength"];
$fileSize	= $_GET["fileSize"];
$pathLocal 	= urldecode($_GET["pathLocal"]);
$remark		= $_GET["remark"];//
if(empty($remark))
{
	$remark = urldecode($remark);
}
$callback	= $_GET["callback"];//jsonp格式用到
$json 		= "0";

//相关参数不能为空
if ( strlen($md5) > 0
	 && strlen($uid) > 0
	 && strlen($fileSize) > 0)
{
	$db = new HttpUploaderDB();
	$inf = $db->ExistFileMD5($uid,$md5);
	$inf["uid"] = $uid;
	//存放时不需要编码。fix \字符会导致basename解析错误
	$nameArr = explode('\\',$pathLocal);
	$inf["FileNameLocal"] 	= $nameArr[count($nameArr)-1];
	$inf["FilePathLocal"] 	= $pathLocal;
	$inf["f_remark"]		= $remark;
	$path_parts = pathinfo( $pathLocal );
	//以MD5方式命名。md5.rar
	$inf["FileNameRemote"] = $md5 .".". $path_parts["extension"];
	//以原始文件名称命名。QQ2012.exe
	//$inf["FileNameRemote"] = $inf["FileNameLocal"];
	
	//数据库存在相同数据->添加一条数据
	if(1 == $inf["exist"])
	{
		$inf["FileNameLocal"] = $nameArr[count($nameArr)-1];
		$inf["FilePathLocal"] = $pathLocal;
		//echo "debug信息： inf信息：".$inf["FilePathRemote"]."<br/>";
		$inf["fid"] = $db->InsertArr($inf);
		$inf["uid"] = $uid;//将文件UID设为当前用户ID
	}//没有数据
	else
	{
		$cfg = new HttpUploaderConfig();
		$inf["uid"] 		= $uid;//将文件UID设为当前用户ID
		$inf["FileLength"] 	= $fileLength;
		$inf["FileSize"] 	= $fileSize;
		//创建上传目录
		$cfg->CreateUploadPath();
		$inf["FilePathRemote"] = $cfg->GetUploadPath().$inf["FileNameRemote"];
		$inf["FilePathRelative"] = $cfg->GetRelatPath().$inf["FileNameRemote"];
		$inf["fid"] = $db->InsertArr($inf);
		
		//创建文件
		$resu = new FileResumer();
		$resu->CreateFile($inf["FilePathRemote"],$inf["FileLength"]);
	}
	
	//拼接JSON
	$json = $callback . "([{s:0";
	while( list($key, $val) = each($inf) ) 
	{
		//输出时需要转换编码
		if($key == "FileNameLocal"
		   || $key == "FilePathLocal"
		   || $key == "FilePathRemote"
		   || $key == "FilePathRelative"
		   || $key == "f_remark")
		{
			$val = urlencode($val);
		}
		$json = $json.",".$key.':"'.$val.'"';
	}
	$json = $json."}])";
}
echo $json;//必须返回jsonp格式数据
header('Content-Length: ' . ob_get_length());
?>