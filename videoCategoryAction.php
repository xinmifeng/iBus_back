<?php
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
require_once("./PublicAction.php");
$sign = $_POST["sign"];
switch ($sign) {
    case "insert": //������Ƶ����
        $typeName = $_POST["typeName"];
        $orderID = $_POST["orderID"];
        if (!empty($_POST["typeID"])) { //�������ID�����޸ļ�¼
            $typeID = $_POST["typeID"];
            $data = Array(
                'type_name' => $typeName,
                //			 'create_date' => $DB->now(), //�޸Ĵ���ʱ��
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
                $DB->insert("history", $history); //��Ӳ�����ʷ��¼
            }
        }
        break;
    case "toUpdate": //�����޸���Ƶ����
        $typeID = $_POST["tid"];
        $DB->where("type_id", $typeID);
        $data = $DB->getOne("video_type");
        header("Content-type: application/json");
        echo json_encode($data);
        break;

    case "delete": //ɾ����Ƶ����
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