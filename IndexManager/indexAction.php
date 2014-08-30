<?php
/**
 * index管理action
 *
 * @author  dennis
 * @version 1.0
 * @package main
 */
require_once("../MysqliDb.php");
require_once("../sqlDb.php");
require_once("../PublicAction.php");


$sign = $_POST["sign"];
$Result = "";
switch ($sign) {
    case"Index":
        $index_id = $_POST["id"];
        $data1 = $_POST["UData"];


        $DB->where("index_id", $index_id);
        $CostInstan = $DB->get("index");
        $arrayData = GetCostAndUpdateValue($CostInstan, $data1);

        $DB->where('index_id', $index_id);
        $count1 = $DB->update('index', $data1);

        $HistoryData = UpdateHistory($arrayData, "index_id", $index_id, "bee_index");

        if ($count1 > 0) {
            $DB->insert("history", $HistoryData);
        }
        $Result = $index_id;

        break;
    default;
        $position = $_POST["position"];
        $index_type = $_POST["index_type"];
        $src = $_POST["src"];
        $pic_url = $_POST["pic_url"];
        $details_id = $_POST["details_id"];
        $data = Array(
            'index_type' => $index_type,
            'pic_url' => $pic_url,
            'src' => $src,
            'details_id' => $details_id,
        );


        $DB->where("index_id", $position);
        $CostInstan = $DB->get("index");
        $arrayData = GetCostAndUpdateValue($CostInstan, $data);


        $DB->where('index_id', $position);
        $DB->update('index', $data);

        $HistoryData = UpdateHistory($arrayData, "index_id", $position, "bee_index");

        $DB->insert("history", $HistoryData);

        $Result = $position;
        break;
}
echo $Result;
?>