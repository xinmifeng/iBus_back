<?php
/**
 * 新增或者修改banner.
 *
 * @author  Dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
$array = array("111", "222");
$DB->where('index_id', $array, 'IN');
$Dataad = $DB->get("index");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>

    <link href="swfupload/css/default.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="swfupload/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="swfupload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="swfupload/js/fileprogress.js"></script>
    <script type="text/javascript" src="swfupload/js/handlers.js"></script>
    <script type="text/javascript" src="js/Upload.js"></script>
    <script src="js/Banner.js"></script>
    <script src="js/JunValidator/JunValidator.js"></script>
    <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
    <script>
        var swfu;
        var swfu1;
        window.onload = function () {
            swfu = ModelRegister();
            swfu1 = ModelVideo();
        };
        function fileDialogComplete() {
            swfu.startUpload();
            swfu1.startUpload();
        }

        ///更新对应图片
        function UpUrl(DataUp) {
            console.log(DataUp);
            $.ajax({
                "type": "post",
                "url": "AdAction.php",
                "data": DataUp,
                success: function (d) {
                    var arryData = d.split(',');
                    $("#" + arryData[0] + "_url").attr("src", "/swfupload/file/" + arryData[1]);
                }
            });
        }
    </script>
</head>
<body>
<DIV class=main_title>广告图片管理</DIV>
<table class="form">
    <tr>
        <td class="item_title">注册页面广告图片：</td>
        <td>
            <form id="form1" action="./swfupload/index.php" method="post" enctype="multipart/form-data">
                <div>
                    <span id="spanButtonPlaceHolderReg"></span>

                    <div id="fsUploadProgressReg"></div>
                    <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                           style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                </div>

            </form>
            <input type="text" style="display: none" id="RegisterInfo"/>
            <img id="reg_url" src="<?php
            $ImageUrl = "./swfupload/file/";
            foreach ($Dataad as $url) {
                if ($url["index_id"] == "111") {
                    $ImageUrl .= $url["pic_url"];
                    break;
                }
            }
            echo $ImageUrl;
            ?>" style="width:320px;height: 217px"/>
        </td>
    </tr>
    <tr>
        <td class="item_title">视频页面广告图片：</td>
        <td>
            <form id="form1" action="./swfupload/index.php" method="post" enctype="multipart/form-data">
                <div>
                    <span id="spanButtonPlaceHolderVideo"></span>

                    <div id="fsUploadProgressVideo"></div>
                    <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                           style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                </div>

            </form>
            <input type="text" style="display: none" id="VideoInfo"/>
            <img id="video_url" src="<?php
            $imgUrl = "./swfupload/file/";
            foreach ($Dataad as $v) {
                if ($v["index_id"] == "222") {
                    $imgUrl .= $v["pic_url"];
                    break;
                }
            }
            echo $imgUrl;
            ?>" style="width:320px;height: 217px"/>
        </td>
    </tr>
    <tr>
        <td class="item_title"></td>
        <td>
            <input type="button" class="button" id="btn_add" name="add" onclick="fileDialogComplete();" value="保存"/>
        </td>
    </tr>
</table>
</body>
</html>

