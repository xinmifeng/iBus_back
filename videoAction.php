<?php
/**
 * 视频管理action
 *
 * @author  dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("sqlDb.php");
require_once("./PublicAction.php");


$sign = $_POST["sign"];
switch ($sign) {
    case "insert": //新增视频信息
        $type_id = $_POST["type_id"];
        $title = $_POST["title"];
        $pic_url = $_POST["pic_url"];
        $v_name = $_POST["v_name"];
        $address = $_POST["address"];
        $length = $_POST["length"];
        $orderID = $_POST["order_id"];
        $GUID = "";

        if (!empty($_POST["v_id"])) { //如果存在ID，就修改记录
            $v_id = $_POST["v_id"];
            $data = Array(
                'type_id' => $type_id,
                'title' => $title,
                'pic_url' => $pic_url,
                'v_name' => $v_name,
                'length' => $length,
                'order_id' => $orderID
            );


            $DB->where("v_id", $v_id);
            $CostInstan = $DB->get("video");
            $arrayData = GetCostAndUpdateValue($CostInstan, $data);

            $DB->where('v_id', $v_id);
            $DB->update('video', $data);
            $HistoryData = UpdateHistory($arrayData, "v_id", $v_id, "bee_video");
            if (count($arrayData["Update"]) > 0) {
                $DB->insert("history", $HistoryData);
            }

            $GUID = $v_id;
        } else {
            $data = Array(
                'type_id' => $type_id,
                'title' => $title,
                'pic_url' => $pic_url,
                'v_name' => $v_name,
                'length' => $length,
                'create_date' => date("Y-m-d H:i:s"),
                'order_id' => $orderID
            );
            $GUID = $DB->insert('video', $data);
            if ($GUID > 0) {
                $data["v_id"] = $GUID;
                $History = AddHistory($data, "bee_video");
                $DB->insert("history", $History);
            }
        }
        echo $GUID;
        break;
    case "update":
        $UpdateAddress = $_POST["UData"];
        $id = $_POST["id"];


        $DB->where("v_id", $id);
        $CostInstan = $DB->get("video");
        $arrayData = GetCostAndUpdateValue($CostInstan, $UpdateAddress);

        $DB->where('v_id', $id);
        $ECount = $DB->update('video', $UpdateAddress);
        $HistoryData = UpdateHistory($arrayData, "v_id", $id, "bee_video");
        if ($ECount > 0 && count($arrayData["Update"]) > 0) {
            $DB->insert("history", $HistoryData);
        }
        echo $ECount;
        break;
    case "delete": //删除视频分类
        $tIDs = $_POST["tids"];

        $DB->where("v_id", $tIDs, 'IN');
        $ActivInstan = $DB->get("video");
        $DelArray = DelHistory($ActivInstan, "bee_video", "v_id", $tIDs);
        $DB->insert("history", $DelArray);

        $DB->where('v_id', $tIDs, 'IN');
        $bojInstan = $DB->get("video");
        for ($i = 0; $i < count($bojInstan); $i++) {
            $url = $bojInstan[$i]["address"];
            $purl = $bojInstan[$i]["pic_url"];

            if (is_file("swfupload/file/" . $url)) {
                unlink("swfupload/file/" . $url);
            }
            if (is_file("swfupload/file/" . $purl)) {
                unlink("swfupload/file/" . $purl);
            }
        }
        $DeltIDs = $_POST["tids"];
        $DB->where('v_id', $DeltIDs, 'IN');
        $count1 = $DB->delete('video');
        echo $count1;
        break;
}

?>