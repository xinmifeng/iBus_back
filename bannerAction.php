<?php
/**
 * banner管理action
 *
 * @author  dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("sqlDb.php");
$sign = $_POST["sign"];
switch ($sign) {
    case "select": //查询关联标题
        $i = 0;
        $details_type = $_POST["details_type"];
        switch ($details_type) {
            case '1': //活动及应用
                $cols = Array("id", "title");
                $dataLists = $DB->get("activity", null, $cols);
                if ($DB->count > 0)
                    foreach ($dataLists as $dataList) {
                        $arrayData[$i][0] = $dataList["id"];
                        $arrayData[$i][1] = $dataList["title"];
                        $i++;
                    }
                header("Content-type: application/json");
                echo json_encode($arrayData);
                break;
            case '2': //视频
                $cols = Array("v_id", "title");
                $dataLists = $DB->get("video", null, $cols);
                if ($DB->count > 0)
                    foreach ($dataLists as $dataList) {
                        $arrayData[$i][0] = $dataList["v_id"];
                        $arrayData[$i][1] = $dataList["title"];
                        $i++;
                    }
                header("Content-type: application/json");
                echo json_encode($arrayData);
                break;
        }
        break;
    case "insert": //新增banner信息

        $type = $_POST["type"];
        $title = $_POST["title"];
        $picture_url = $_POST["picture_url"];
        $src = $_POST["src"];
        $address = $_POST["address"];
        $details_type = $_POST["details_type"];
        $details_id = $_POST["details_id"];
        $orderID = $_POST["order_id"];
        $sub_type = $_POST["sub_type"];
        $ECHID = 0;
        if (!empty($_POST["id"])) { //如果存在ID，就修改记录
            $id = $_POST["id"];
            $ECHID = $id;
            $data = Array(
                'type' => $type,
                'title' => $title,
                'picture_url' => $picture_url,
                'src' => $src,
                'details_type' => $details_type,
                'details_id' => $details_id,
                //			 'create_date' => $DB->now(), //修改创建时间
                'order_id' => $orderID,
                'sub_type' => $sub_type
            );
            $DB->where('id', $id);
            $DB->update('banner', $data);
        } else {
            $data = Array(
                'type' => $type,
                'title' => $title,
                'picture_url' => $picture_url,
                'src' => $src,
                'details_type' => $details_type,
                'details_id' => $details_id,
                'create_date' => $DB->now(), //修改创建时间
                'order_id' => $orderID,
                'sub_type' => $sub_type
            );
            $ECHID = $DB->insert('banner', $data);
        }
        // header('Location:videoList.php');
        echo $ECHID;
        break;

    case "delete": //删除视频分类
        $tIDs = $_POST["tids"];
        $DB->where('id', $tIDs, 'IN');
        $bojInstan = $DB->get("banner");
        for ($i = 0; $i < count($bojInstan); $i++) {
            $purl = $bojInstan[$i]["picture_url"];
            if (is_file("SWFUpload/file/" . $purl)) {
                unlink("SWFUpload/file/" . $purl);
            }
        }
        $tIDs = $_POST["tids"];
        $DB->where('id', $tIDs, 'IN');
        $DB->delete('banner');
        break;
    case "UPData":
        $Id = $_POST["id"];
        $UpData = $_POST["UData"];
        $DB->where("id", $id);
        $count = $DB->update("banner", $UpData);
        echo $count;
        break;
}

?>