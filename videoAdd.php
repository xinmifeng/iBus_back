<?php
/**
 * 新增视频.
 *
 * @author  Dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
if (!empty($_GET["v_id"])) {
    $v_id = $_GET["v_id"];
    $DB->where("v_id", $v_id);
    $video = $DB->getOne("video");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>
    <script src="js/Video.js"></script>

    <link href="swfupload/css/default.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="swfupload/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="swfupload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="swfupload/js/fileprogress.js"></script>
    <script type="text/javascript" src="swfupload/js/handlers.js"></script>
    <script type="text/javascript" src="js/Upload.js"></script>
    <script src="js/JunValidator/JunValidator.js"></script>


    <link href="CSS/style.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" language="javascript">
        var swfu;
        var swfu1;
        window.onload = function () {
            swfu = ModelUpload3();
            swfu1 = ModelUpload4();
        };
        function fileDialogComplete() {
            swfu.startUpload();
            swfu1.startUpload();
        }
    </script>
</head>
<body>
<DIV class=main_title>编辑视频</DIV>
<table class="form">
    <tr>
        <td class="item_title">标题：</td>
        <td><input type="hidden" id="sign" name="sign"/>
            <input type="hidden" id="v_id" class="v_id" name="v_id"
                   value="<?php if (!empty($v_id)) {
                       echo $v_id;
                   } ?>"/>
            <input type="text" class="title checkInput" id="title" name="title"
                   empty="false" emptymsg="标题不能为空" illleagle="标题长度为1~20" reg="title"
                   value="<?php if (!empty($video['title'])) {
                       echo $video['title'];
                   } ?>"/>
        </td>
    </tr>
    <tr>
        <td class="item_title">视频名称：</td>
        <td><input type="select" class="v_name checkInput" id="v_name" name="v_name"
                   empty="false" emptymsg="视频名称不能为空" illleagle="视频名称长度为1~20" reg="title"
                   value="<?php if (!empty($video['v_name'])) {
                       echo $video['v_name'];
                   } ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">视频所属分类：</td>
        <td>
            <select id="type_id" value="<?php if (!empty($video['type_id'])) {
                echo $video['type_id'];
            } ?>">
                <?php
                if (!empty($video['type_id'])) {
                    ?>
                    <option value="<?php echo $video['type_id'] ?>"><?php
                        $DB->where("type_id", $video['type_id']);
                        $vType = $DB->getOne("video_type");
                        echo $vType["type_name"];
                        ?></option>
                <?php
                }
                $DB->orderBy("order_id", "asc");
                $result = $DB->get("video_type");
                foreach ($result as $v) {
                    ?>
                    <option value="<?php echo $v['type_id'] ?>"><?php echo $v['type_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="item_title">展示图片地址</td>
        <td>

            <form id="form1" action="swfupload/index.php" method="post" enctype="multipart/form-data">
                <div>
                    <span id="spanButtonPlaceHolder4"></span>

                    <div id="fsUploadProgress4"></div>
                    <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                           style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                </div>
            </form>
            <input type="text" style="display: none" id="Video4_msg"/>


            <input type="text" class="pic_url" name="pic_url" id="pic_url"
                   value="<?php if (!empty($video['pic_url'])) {
                       echo $video['pic_url'];
                   } ?>"/>

        </td>
    </tr>
    <tr>
        <td class="item_title">视频上传：</td>
        <td>
            <form id="form1" action="swfupload/index.php" method="post" enctype="multipart/form-data">
                <div>
                    <span id="spanButtonPlaceHolder5"></span>

                    <div id="fsUploadProgress5"></div>
                    <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                           style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                </div>
            </form>
            <input type="text" style="display: none" id="Video5_msg"/>

            <input type="text" class="address" name="address" id="address"
                   value="<?php if (!empty($video['address'])) {
                       echo $video['address'];
                   } ?>"/>
        </td>
    </tr>
    <tr>
        <td class="item_title">时长：</td>
        <td><input type="text" class="length checkInput" id="length" name="length"
                   empty="false" emptymsg="时长不能为空" illleagle="视频时长格式为:00:20:38 (代表0小时20分38秒)" reg="time"
                   value="<?php if (!empty($video['length'])) {
                       echo $video['length'];
                   } ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">排序值</td>
        <td><input type="text" class="OrderID checkInput" id="order_id" name="order_id"
                   empty="false" emptymsg="排序值不能为空" illleagle="排序值为数字" reg="num"
                   value="<?php
                   if (!empty($video['order_id'])) {
                       echo $video['order_id'];
                   } else {
                       $maxOrderID = $DB->getOne("video", "max(order_id) as maxID");
                       echo $maxOrderID['maxID'] + 10;
                   }
                   ?>"/></td>
    </tr>
    <tr>
        <td class="item_title"></td>
        <td><input type="button" name="add" id="btn_add" class="button" value="确定"/><input type="button"
                                                                                           name="back"
                                                                                           value="返回"
                                                                                           class="button"
                                                                                           onclick="goback();"/>
        </td>
    </tr>
</table>
</body>
</html>
<script>
    var Regs = {
        title: /^.{1,20}$/,
        time: /^[0-5][0-9]:[0-5][0-9]:[0-5][0-9]$/,
        num: /^\d{1,4}$/
    };
    $inputs = $(".checkInput");
    var validator = new JunValidator({
        "Regs": Regs,
        "elements": $inputs,
        "blurAfter": function (element, data) {
            addJunIcon(element, data);
        }
    });
    $("#btn_add").click(function () {
        insertDate(validator);
    });
</script>
