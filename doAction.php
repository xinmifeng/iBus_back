<?php
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
$title = $_GET["sign"];
switch ($title) {
    case "Event_HD":
        $arr = array('title' => $_GET["hd_title"], 'web_url' => $_GET["hd_webUrl"], 'create_date' => date("Y-m-d H:i:s"), 'type' => $_GET["hd_type"], 'app_type' => $_GET["hd_apptype"]);
        $id = $DB->insert("activity", $arr);
        echo $id;
        break;
    case "Event_HD_Search":
        echo SearchAllList($DB);
        break;
    case "Del":
        $DB->where("id", $_GET["id"]);
        $ActivInstan = $DB->get("activity");
        $Purl = $ActivInstan[0]["picture_url"];
        $Srcurl = $ActivInstan[0]["src"];
        $DownUrl = $ActivInstan[0]["download_url"];
        if (is_file("SWFUpload/file/" . $Purl)) {
            unlink("SWFUpload/file/" . $Purl);
        }
        if (is_file("SWFUpload/file/" . $Srcurl)) {
            unlink("SWFUpload/file/" . $Srcurl);
        }
        if (is_file("SWFUpload/file/" . $DownUrl)) {
            unlink("SWFUpload/file/" . $DownUrl);
        }
        $DB->where("id", $_GET["id"]);
        $delSign = $DB->delete("activity");
        if ($delSign > 0) {
            echo SearchAllList($DB);
        }
        break;
    case "updateShow":
        $DB->where("id", $_GET["id"]);
        $data = $DB->get("activity");
        echo json_encode($data);
        break;
    case "ExecUpdate";
        //array('title' => $_GET["hd_title"], 'picture_url' => $_GET["hd_pic"], 'src' => $_GET["hd_src"], 'create_date' => date("Y-m-d H:i:s"), 'type' => $_GET["hd_type"], 'app_type' => '5');
//        if (isset($_GET["Utype"])) {
//            $DB->where("id", $_GET["id"]);
//            $act = $DB->get("activity");
//            $Purl = $act[0]["picture_url"];
//            $Srcurl = $act[0]["src"];
//            $DownUrl = $act[0]["download_url"];
//
//            if (is_file("SWFUpload/file/" . $Purl)) {
//                unlink("SWFUpload/file/" . $Purl);
//            }
//            if (is_file("SWFUpload/file/" . $Srcurl)) {
//                unlink("SWFUpload/file/" . $Srcurl);
//            }
//            if (is_file("SWFUpload/file/" . $DownUrl)) {
//                unlink("SWFUpload/file/" . $DownUrl);
//            }
//        }
        $arr = $_GET["UData"];
        $DB->where("id", $_GET["id"]);
        $Count = $DB->update("activity", $arr);
        echo $Count;
        break;
    default:
        echo "未找到对应的方法。";
        break;
}

///查询列表 倒序排序
function SearchAllList($DB)
{
    $DB->orderBy("id", "Desc");
    $activity = $DB->get("activity");
    $returHtml = ShowList($activity);
    return $returHtml;
}


///拼接html的数据List
function ShowList($BeeActivity)
{
    $Html = "";
    if (count($BeeActivity) > 0) {
        for ($index = 0; $index < count($BeeActivity); $index++) {
            $num = $index + 1;
            $titleStr = $BeeActivity[$index]['title'];
            $typeStr = $BeeActivity[$index]['type'];
            $PicUrl = $BeeActivity[$index]['picture_url'];
            $createdate = $BeeActivity[$index]['create_date'];
            $idval = $BeeActivity[$index]['id'];
            $Picsrc = $BeeActivity[$index]['src'];
            $Html .= "<tr><td height='20' bgcolor='#FFFFFF'><div align='center'><input type='checkbox' name='checkbox2' value='checkbox'/></div></td><td height='20' bgcolor='#FFFFFF'>
                                        <div align='center' class='STYLE1'>
                                            <div align='center' class='IndexNum'>$num</div>
                        </div>
                        </td>
                        <td height='20' bgcolor='#FFFFFF'>
                            <div align='center'><span
                                    class='STYLE1'>$titleStr</span>
                            </div>
                        </td>
                        <td height='20' bgcolor='#FFFFFF'>
                            <div align='center'><span
                                    class='STYLE1'>$typeStr</span>
                            </div>
                        </td>
                        <td bgcolor='#FFFFFF'>
                            <div align='center'><span
                                    class='STYLE1'>$PicUrl</span>
                            </div>
                        </td>
                         <td bgcolor='#FFFFFF'>
                            <div align='center'><span
                                    class='STYLE1'>$Picsrc</span>
                            </div>
                        </td>
                        <td height='20' bgcolor='#FFFFFF'>
                            <div align='center'><span
                                    class='STYLE1'>$createdate</span>
                            </div>
                        </td>
                        <td height='20' bgcolor='#FFFFFF'>
                            <div align='center'><span class='STYLE4'><img src='../images/edt.gif' width='16' height='16' /><a href='#' onclick='UpdateShow_HD($idval)'>编辑</a>&nbsp; &nbsp;<img
                                        src='../images/del.gif'
                                        width='16' height='16'/><a href='#' onclick='Del_HD($idval,$num)' >删除</a></span>
                            </div>
                        </td>
                        </tr>";
        }
    }
    if (!empty($Html)) {
        return $Html;
    } else {
        return "";
    }
}

?>