<?php
require_once("../MysqliDb.php");
require_once("../sqlDb.php");
$Sign = $_GET["Export"];

switch ($Sign) {
    case "all":
        $file_Name = WriteFile_Sql($DB);
        $SourceFileName = WriteFile_Source($DB, $file_Name);
        echo $SourceFileName;
        break;
    default:
        break;
}

function WriteFile_Sql($DB)
{
    $fileName = date("YmdHis") . '.sql';
    $Instance = $DB->get("history");
    $SqlStr = GetCreateTableSql();
    for ($index = 0; $index < count($Instance); $index++) {
        $SqlStr .= $Instance[$index]["modified_sql"];
    }

    file_put_contents($fileName, $SqlStr);
    return $fileName;
}

function WriteFile_Source($DB, $SqlSource)
{
    $Instance = $DB->get("history");
    $fileName = date("YmdHis") . "File.list";
    $hostUrl = "http:183.247.175.250";

    $ReturnStr = "Add " . $hostUrl . "/DataMange/" . $SqlSource . "\r\n";
    $ReturnStr .= "Add " . $hostUrl . "/swfupload/file/busfree.sqllite" . "\r\n";;
    for ($index = 0; $index < count($Instance); $index++) {
        switch ($Instance[$index]["action"]) {
            case "add":
                $Add_JsonStr = json_decode(($Instance[$index]["modified"]));
                foreach ($Add_JsonStr as $key => $val) {
                    if (FiledType($key) && !is_null($val) && $val != "") {
                        $ReturnStr .= "ADD " . $hostUrl . "/swfupload/file/" . $val . "\r\n";;
                    }
                }
                break;
            case "upd":
                ///修改的时候加载资源文件先删除再添加
                $Upd_JsonStr = json_decode(($Instance[$index]["modified"]));
                $Cost_JsonStr = json_decode(($Instance[$index]["cost"]));
                foreach ($Upd_JsonStr as $key => $val) {
                    foreach ($Cost_JsonStr as $key1 => $val1) {
                        if (FiledType($key) && !is_null($val) && $key == $key1) {
                            if (!is_null($val1) && $val1 != "") {
                                $ReturnStr .= "DEL " . $hostUrl . "/swfupload/file/" . $val1 . "\r\n";;
                            }
                            $ReturnStr .= "ADD " . $hostUrl . "/swfupload/file/" . $val . "\r\n";;
                            break;
                        }
                    }
                }
                break;
            case "del":
                $Del_CostJsonStr = json_decode(($Instance[$index]["cost"]));
                foreach ($Del_CostJsonStr as $key2 => $val2) {
                    foreach ($val2 as $k1 => $v1) {
                        if (FiledType($k1) && !is_null($v1) && $v1 != "") {
                            $ReturnStr .= "DEL " . $hostUrl . "/swfupload/file/" . $v1 . "\r\n";;
                        }
                    }
                    break;
                }
                break;
        }
    }
    file_put_contents($fileName, $ReturnStr);
    return $fileName;
}

///判断是否为资源字段
function FiledType($fType)
{
    $boolSign = false;
    switch ($fType) {
        case "picture_url":
            $boolSign = true;
            break;
        case "download_url":
            $boolSign = true;
            break;
        case "src":
            $boolSign = true;
            break;
        case "pic_url":
            $boolSign = true;
            break;
        case "address":
            $boolSign = true;
            break;
    }
    return $boolSign;
}


//获取创建表sql语句
function GetCreateTableSql()
{
    $SQL = "CREATE TABLE IF NOT EXISTS  `bee_activity` (
    `id` integer primary key AUTOINCREMENT NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `picture_url` varchar(128) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `app_type` varchar(50) DEFAULT NULL,
  `download_url` varchar(256) DEFAULT NULL,
  `web_url` varchar(256) DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS `bee_banner` (
    `id` integer primary key AUTOINCREMENT NOT NULL,
  `picture_url` varchar(128) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `order_id` int(5) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `details_id` int(5) DEFAULT NULL,
  `details_type` varchar(256) DEFAULT NULL,
  `sub_type` varchar(32) DEFAULT NULL
);
CREATE TABLE  IF NOT EXISTS  `bee_history` (
    `Id` integer primary key AUTOINCREMENT NOT NULL,
  `table_name` text,
  `action` varchar(100) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `modified` text,
  `modified_sql` varchar(255) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `export_time` datetime DEFAULT NULL
);
CREATE TABLE  IF NOT EXISTS  `bee_index` (
    `index_id` integer primary key AUTOINCREMENT NOT NULL,
  `index_type` int(4) DEFAULT NULL,
  `pic_url` varchar(256) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `position` int(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `details_id` int(4) DEFAULT NULL
);
CREATE TABLE  IF NOT EXISTS  `bee_system_user` (
    `id` integer primary key AUTOINCREMENT NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
);
CREATE TABLE  IF NOT EXISTS  `bee_user` (
    `id` integer primary key AUTOINCREMENT NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
);
CREATE TABLE  IF NOT EXISTS  `bee_user_history` (
    `his_id` integer primary key AUTOINCREMENT NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `src_id` int(5) DEFAULT NULL,
  `count` int(5) DEFAULT NULL,
  `is_like` varchar(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `src_type` int(5) DEFAULT NULL
);
CREATE TABLE  IF NOT EXISTS  `bee_video` (
    `v_id` integer primary key AUTOINCREMENT NOT NULL,
  `type_id` int(5) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `pic_url` varchar(256) DEFAULT NULL,
  `v_name` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `length` varchar(32) DEFAULT NULL,
  `total_like` int(5) DEFAULT '0',
  `count` varchar(64) DEFAULT '0',
  `order_id` int(5) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
);
CREATE TABLE IF NOT EXISTS `bee_video_type` (
    `type_id` integer primary key AUTOINCREMENT NOT NULL,
  `type_name` varchar(32) DEFAULT NULL,
  `order_id` int(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
);";
    return $SQL;
}

?>