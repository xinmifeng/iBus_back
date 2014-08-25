<?php
require_once("../MysqliDb.php");
require_once("../sqlDb.php");

header("content-Type: text/html; charset=gb2312");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>活动管理</title>
    <script src="../bower_components/jquery/jquery.js"></script>
    <script type="text/javascript" src="../js/layer/layer/layer.min.js"></script>
    <script type="text/javascript" src="../js/Layerutility.js"></script>
    <script type="text/javascript" src="../js/EventsManger.js"></script>

    <link href="../SWFUpload/css/default.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../SWFUpload/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="../SWFUpload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="../SWFUpload/js/fileprogress.js"></script>
    <script type="text/javascript" src="../SWFUpload/js/handlers.js"></script>
    <script type="text/javascript" src="../js/Upload.js"></script>


    <link href="../CSS/style.css" rel="stylesheet" type="text/css"/>

    <script>
        var swfu;
        var swfu1;
        var swfu2;
        window.onload = function () {
            swfu = ModelUpload();
            swfu1 = ModelUpload1();
            swfu2 = ModelUpload2();
        };
        function fileDialogComplete() {
            alert("Add数据成功");
            swfu.startUpload();
            swfu1.startUpload();
            swfu2.startUpload();
        }

        $(document).ready(function () {
            if ($("#btnsel").val() != "") {
                $("#Sel_type").val($("#btnsel").val())
            }
        });


    </script>
</head>

<body>
<DIV class=main_title>新增活动及应用</DIV>
<table class="form">
    <?php
    if (empty($_GET["id"])) {
        ?>
        <tr>
            <td class="item_title">活动标题：</td>
            <td><input type="text" id="hd_title"/></td>
        </tr>
        <tr>
            <td class="item_title">活动类型：</td>
            <td><select id="Sel_type">
                    <option value="限时活动">限时活动</option>
                    <option value="活动">活动</option>
                    <option value="应用（游戏）">应用（游戏）</option>
                    <option value="应用（App）">应用（App）</option>
                </select>
        </tr>
        <tr>
            <td class="item_title">外链地址：</td>
            <td><input type="text" id="hd_src"/>(无外链可忽略)</td>
        </tr>
        <tr>
            <td class="item_title">图片上传：</td>
            <td>
                <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <span id="spanButtonPlaceHolder"></span>

                        <div id="fsUploadProgress"></div>
                        <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                               style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                    </div>

                </form>
                <input type="text" style="display: none" id="ImageInfo"/></td>
        </tr>
        <tr>
            <td class="item_title">详细图片上传：</td>
            <td>
                <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <span id="spanButtonPlaceHolder1"></span>

                        <div id="fsUploadProgress1"></div>
                        <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                               style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                    </div>

                </form>
                <input type="text" style="display: none" id="ImageDetails"/></td>
        </tr>
        <tr>
            <td class="item_title">应用上传：</td>
            <td>

                <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <span id="spanButtonPlaceHolder2"></span>

                        <div id="fsUploadProgress2"></div>
                        <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                               style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                    </div>

                </form>
                <input type="text" style="display: none" id="apk_id"/></td>
        </tr>

        <tr>
            <td class="item_title"><input type="button" value="提交" class="SaveChange"
                                                 onclick="SubmitToAction();"/>
            </td>
            <td><input type="button" value="关闭" id="closebtn"/></td>
        </tr>
    <?php
    } else {
        $id = $_GET["id"];
        $DB->where("id", $id);
        $Data = $DB->get("activity");
        $title = $Data[0]["title"];
        $web_url = $Data[0]["web_url"];
        $Type = $Data[0]["type"];

        ?>
        <tr>
            <td class="item_title">活动标题：</td>
            <td><input type="text" id="hd_title" value="<?php echo iconv('UTF-8', 'GB2312', $title) ?>"/></td>
        </tr>
        <tr>
            <td class="item_title">活动类型：</td>
            <td><select id="Sel_type">
                    <option value="限时活动">限时活动</option>
                    <option value="活动">活动</option>
                    <option value="应用（游戏）">应用（游戏）</option>
                    <option value="应用（App）">应用（App）</option>
                </select>
                <input type="hidden" id="btnsel" value="<?php echo iconv('UTF-8', 'GB2312', $Type); ?>"/></td>
        </tr>
        <tr>
            <td class="item_title">外链地址：</td>
            <td><input type="text" id="hd_src" value="<?php echo iconv('UTF-8', 'GB2312', $web_url) ?>"/>(无外链可忽略)</td>
        </tr>
        <tr>
            <td class="item_title">图片上传：</td>
            <td>
                <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <span id="spanButtonPlaceHolder"></span>

                        <div id="fsUploadProgress"></div>
                        <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                               style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                    </div>

                </form>
                <input type="text" style="display: none" id="ImageInfo"/></td>
        </tr>
        <tr>
            <td class="item_title">详细图片上传：</td>
            <td>
                <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <span id="spanButtonPlaceHolder1"></span>

                        <div id="fsUploadProgress1"></div>
                        <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                               style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                    </div>

                </form>
                <input type="text" style="display: none" id="ImageDetails"/></td>
        </tr>
        <tr>
            <td class="item_title">应用上传：</td>
            <td>

                <form id="form1" action="../SWFUpload/index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <span id="spanButtonPlaceHolder2"></span>

                        <div id="fsUploadProgress2"></div>
                        <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                               style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                    </div>

                </form>
                <input type="text" style="display: none" id="apk_id"/></td>
        </tr>

        <tr>
            <td class="item_title"><input type="button" value="提交" class="SaveChange"
                                                 onclick="ExecuteUpdate(<?php echo $id; ?>);"/>
            </td>
            <td><input type="button" value="关闭" id="closebtn"/></td>
        </tr>
    <?php } ?>
</table>
</div>
</body>
</html>

