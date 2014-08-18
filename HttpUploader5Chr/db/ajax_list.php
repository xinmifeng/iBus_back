<?php
ob_start();
header('Content-Type: text/html;charset=utf-8');
/*
	列表出所文件列表，包括未上传完成的，以JSON方式返回给客户端JS。
*/
require('HttpUploaderDB.php');

$uid = $_GET["uid"];
$callback = $_GET["callback"];
$json = $callback . "([";

//md5和uid不能为空
if ( strlen($uid) > 0)
{
	$db = new HttpUploaderDB();
	$con = $db->GetCon();
	//设置字符集
	$sql = "set names utf8";
	$con->query($sql);
	
	//取数据
	$sql = "select * from xdb_files where IsDeleted=0 and uid=".intval($uid);
	
	if( $result = $con->query($sql) )
	{
		$itemArray = array();
		while ($row = $result->fetch_assoc()) 
		{
			$item = "{s:0";
			while (list($key, $value) = each($row)) 
			{
				//输出时需要转换编码
				if( $key == "FilePathLocal"
				   || $key == "FilePathRemote"
				   || $key == "FilePathRelative")
				{
					$value = urlencode($value);
					$value = str_replace("+","%20",$value);
				}
				$item = $item.",".$key.':"'.$value.'"';
			}
			$item = $item."}";
			array_push($itemArray,$item);
		}
		$result->close();
		$json = $json.implode(",",$itemArray);
	}
	/* 关闭连接 */
	$con->close();
}
$json = $json."])";

//返回查询结果
echo $json;
header('Content-Length: ' . ob_get_length());
?>