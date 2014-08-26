<?php
/**
 * 编辑主页.
 *
 * @author  Dennis
 * @version 1.0
 * @package main
 */
require_once("../MysqliDb.php");
require_once("../sqlDb.php");
if (!empty($_GET["position"])) {
    $position = $_GET["position"];
    $DB->where("index_id", $position);
    $index = $DB->getOne("index");
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
    <script src="../bower_components/jquery/jquery.js"></script>
    <script src="../js/layer/layer/layer.min.js"></script>
    <script src="../js/Layerutility.js"></script>
    <link href="../CSS/style.css" rel="stylesheet" type="text/css"/>

    <link href="../SWFUpload/css/default.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../SWFUpload/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="../SWFUpload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="../SWFUpload/js/fileprogress.js"></script>
    <script type="text/javascript" src="../SWFUpload/js/handlers.js"></script>
    <script type="text/javascript" src="../js/Upload.js"></script>
    <script type="text/javascript" src="../js/indexManager.js"></script>

    <script>
        var swfu;
        window.onload = function () {
            swfu = ModelUploadIndex();
        };
        function fileDialogComplete() {
            swfu.startUpload();
        }
    </script>
</head>
<body>
<DIV class=main_title>首页编辑</DIV>
<table class="form">
    <tr>
        <td class="item_title">位置代号：</td>
        <td><?php echo $index["index_id"] ?>
            <input type="hidden" id="position" name="position" value="<?php echo $index["index_id"]; ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">主页类别：</td>
        <td>
            <input type="hidden" id="typeValue" name="typeValue" value="<?php if (!empty($index['index_type'])) {
                echo $index['index_type'];
            } ?>">
            <select id="index_type" name="index_type" value="">
                <option value="1">首页</option>
                <option value="2">优惠</option>
            </select></td>
    </tr>
    <tr>
        <td class="item_title">展示图片地址</td>
        <td>

            <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                <div>
                    <span id="spanButtonPlaceHolder7"></span>

                    <div id="fsUploadProgress7"></div>
                    <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                           style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                </div>

            </form>
            <input type="text" style="display: none" id="Image_Type"/>

            <input type="text" class="pic_url" name="pic_url" id="pic_url"
                   value="<?php if (!empty($index['pic_url'])) {
                       echo $index['pic_url'];
                   } ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">链接：</td>
        <td><input type="text" class="src" id="src" name="src" value="<?php if (!empty($index['src'])) {
                echo $index['src'];
            } ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">绑定标题：</td>
        <td>
            <input type="hidden" id="details_text" name="details_text" value="<?php
            if ($position == "2" || $position == "3") {
                $DB->where("v_id", $index['details_id']);
                $details_text = $DB->getOne("video");
            } else {
                $DB->where("id", $index['details_id']);
                $details_text = $DB->getOne("activity");
            }
            echo $details_text["title"];
            ?>"/>
            <input type="hidden" id="details_id_value" name="details_id_value"
                   value="<?php if (!empty($index['details_id'])) {
                       echo $index['details_id'];
                   } ?>"/>
            <select id="details_id" name="details_id" value="">
                <option value="<?php
                echo $index['details_id'];?>"><?php
                    echo $details_text["title"]?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="item_title">
        </td>
        <td><input type="button" class="button" name="add" value="确定" onclick="insertDate();"/><input class="button"
                                                                                                      type="button"
                                                                                                      name="back"
                                                                                                      value="返回"
                                                                                                      onclick="goback();"/>
        </td>
    </tr>
</table>

</body>
</html>