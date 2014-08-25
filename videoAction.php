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
                //			 'create_date' => $DB->now(), //修改创建时间
                'order_id' => $orderID
            );
            $DB->where('v_id', $v_id);
            $DB->update('video', $data);
            $GUID = $v_id;
        } else {
            $data = Array(
                'type_id' => $type_id,
                'title' => $title,
                'pic_url' => $pic_url,
                'v_name' => $v_name,
                'length' => $length,
                'create_date' => $DB->now(),
                'order_id' => $orderID
            );
            $GUID = $DB->insert('video', $data);
        }
        // header('Location:videoList.php');
        echo $GUID;
        break;
    case "update":
        $UpdateAddress = $_POST["UData"];
        $id = $_POST["id"];
        $DB->where('v_id', $id);
        $ECount = $DB->update('video', $UpdateAddress);
        echo $ECount;
        break;
    case "delete": //删除视频分类
        $tIDs = $_POST["tids"];
        $DB->where('v_id', $tIDs, 'IN');
        $bojInstan = $DB->get("video");
        for ($i = 0; $i < count($bojInstan); $i++) {
            $url = $bojInstan[$i]["address"];
            $purl = $bojInstan[$i]["pic_url"];

            if (is_file("SWFUpload/file/" . $url)) {
                unlink("SWFUpload/file/" . $url);
            }
            if (is_file("SWFUpload/file/" . $purl)) {
                unlink("SWFUpload/file/" . $purl);
            }
        }
        $DeltIDs = $_POST["tids"];
        $DB->where('v_id', $DeltIDs, 'IN');
        $count1 = $DB->delete('video');
        echo $count1;
        break;
}

?>