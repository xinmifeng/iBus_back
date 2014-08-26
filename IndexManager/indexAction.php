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


$sign = $_POST["sign"];
$Result = "";
switch ($sign) {
    case"Index":
        $index_id = $_POST["id"];
        $data1 = $_POST["UData"];
        $DB->where('index_id', $index_id);
        $count1 = $DB->update('index', $data1);
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
        $DB->where('index_id', $position);
        $DB->update('index', $data);
        $Result = $position;
        break;
}
echo $Result;
?>