<?php
//添加历史记录
function AddHistory($ModefyData, $TableNameStr)
{
    $Modefiy = json_encode($ModefyData);;
    $Action = "add";
    $sql = JsonParsSql($TableNameStr, $ModefyData);
    $array = array("table_name" => $TableNameStr, "action" => $Action, "cost" => "", "modified" => $Modefiy, "modified_sql" => $sql, "action_time" => date("Y-m-d H:i:s"));
    return $array;
}


//添加修改历史记录
function UpdateHistory($ModefyData, $filed, $val, $TableNameStr)
{
    $Modefiy = json_encode($ModefyData["Update"]);
    $CostArr = json_encode($ModefyData["Cost"]);
    $Action = "upd";
    $sql = JsonUpdateParseSql($TableNameStr, $ModefyData["Update"], $filed, $val);
    $array = array("table_name" => $TableNameStr, "action" => $Action, "cost" => $CostArr, "modified" => $Modefiy, "modified_sql" => $sql, "action_time" => date("Y-m-d H:i:s"));
    return $array;
}


///数组转化为sql
function JsonUpdateParseSql($tableName, $ArrayInstan, $id, $idVal)
{
    $sqlStr = "UPDATE " . $tableName . " set ";
    foreach ($ArrayInstan as $key => $val) {
        $sqlStr .= $key . "='" . $val . "',";
    }
    $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 1) . " where " . $id . "='" . $idVal . "'";
    return $sqlStr;
}

///数组转化为Sql语句
function JsonParsSql($tableName, $jsonInstan)
{
    $sqlStr = "INSERT INTO " . $tableName;
    $FiledStr = "(";
    $ValueStr = "(";
    foreach ($jsonInstan as $key => $val) {
        $FiledStr .= $key . ",";
        $ValueStr .= "'" . $val . "',";
    }
    $FiledStr = substr($FiledStr, 0, strlen($FiledStr) - 1);
    $ValueStr = substr($ValueStr, 0, strlen($ValueStr) - 1);
    $FiledStr .= ")";
    $ValueStr .= ")";
    return $sqlStr . " " . $FiledStr . " values " . $ValueStr . ";";
}

///获取修改了的值和原值
function GetCostAndUpdateValue($Cost, $Upd)
{
    $CostArray = array(); //原值
    $UpdateArry = array(); //修改的值
    $ResultArray = array(); //返回数组
    foreach ($Upd as $key => $val) {
        if ($val != $Cost[0][$key]) {
            $CostArray[$key] = $Cost[0][$key];
            $UpdateArry[$key] = $val;
        }
    }
    $ResultArray["Cost"] = $CostArray;
    $ResultArray["Update"] = $UpdateArry;
    return $ResultArray;
}

///删除记录
function DelHistory($ModefyData, $TableNameStr, $id, $idVal)
{
    $Modefiy = json_encode($ModefyData);
    $Action = "del";
    $sql = JsonParseDel($TableNameStr, $id, $idVal);
    $array = array("table_name" => $TableNameStr, "action" => $Action, "cost" => $Modefiy, "modified" => "", "modified_sql" => $sql, "action_time" => date("Y-m-d H:i:s"));
    return $array;
}

//获取删除语句
function JsonParseDel($TableName, $id, $idVal)
{
    $ids = "";
    for ($index = 0; $index < count($idVal); $index++) {
        $ids .= "'" . $idVal[$index] . "'" . ",";
    }
    $ids .= substr($ids, 0, strlen($ids) - 1);
    $sqlStr = "DELETE FROM " . $TableName . " where " . $id . " in (" . $ids . ");";
    return $sqlStr;
}

///返回对应操作表的名称
function ResultTableDetails($TableName)
{
    $tableName = "";
    switch ($TableName) {
        case "bee_activity":
            $tableName = "活动及应用";
            break;
        case "bee_banner":
            $tableName = "Banner";
            break;
        case "bee_index":
            $tableName = "首页管理";
            break;
        case "bee_video":
            $tableName = "视频";
            break;
        case "bee_video_type":
            $tableName = "视频类型";
            break;
    }
    return $tableName;
}

///操作类型
function GetDoType($typeStr)
{
    $ResuleStr = "";
    switch ($typeStr) {
        case "add":
            $ResuleStr = "添加";
            break;
        case "upd":
            $ResuleStr = "修改";
            break;
        case "del":
            $ResuleStr = "删除";
            break;
        default:
            break;
    }
    return $ResuleStr;
}

?>