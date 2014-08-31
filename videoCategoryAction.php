<?php
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
require_once("./PublicAction.php");
$sign = $_POST["sign"];
switch ($sign) {
    case "insert": //新增视频分类
        $typeName = $_POST["typeName"];
        $orderID = $_POST["orderID"];
        if (!empty($_POST["typeID"])) { //如果存在ID，就修改记录
            $typeID = $_POST["typeID"];
            $data = Array(
                'type_name' => $typeName,
                //			 'create_date' => $DB->now(), //修改创建时间
                'order_id' => $orderID
            );
            $DB->where('type_id', $typeID);
            $CostInstan = $DB->get("video_type");
            $arrayData = GetCostAndUpdateValue($CostInstan, $data);
            $DB->where('type_id', $typeID);
            $result = $DB->update('video_type', $data);
            $HistoryData = UpdateHistory($arrayData, "type_id", $typeID, "bee_video_type");
            if ($result > 0 && count($arrayData["Update"]) > 0) {
                $DB->insert("history", $HistoryData);
            }
            echo $result;
        } else {
            $data = Array(
                'type_name' => $typeName,
                'create_date' => date("Y-m-d H:i:s"),
                'order_id' => $orderID
            );
            $sign = $DB->insert('video_type', $data);
            if ($sign > 0) {
                $data["type_id"] = $sign;
                $history = AddHistory($data, "bee_video_type");
                $DB->insert("history", $history); //添加操作历史记录
            }
        }
        break;
    case "toUpdate": //跳到修改视频分类
        $typeID = $_POST["tid"];
        $DB->where("type_id", $typeID);
        $data = $DB->getOne("video_type");
        header("Content-type: application/json");
        echo json_encode($data);
        break;

    case "delete": //删除视频分类
        $tIDs = $_POST["tids"];

        $DB->where("type_id", $tIDs, 'IN');
        $ActivInstan = $DB->get("video_type");
        $DelArray = DelHistory($ActivInstan, "bee_video_type", "type_id", $tIDs);
        $DB->insert("history", $DelArray);

        $DB->where('type_id', $tIDs, 'IN');
        $count = $DB->delete('video_type');
        echo $count;
        break;
}

?>