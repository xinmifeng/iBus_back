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
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $DB->where("id", $id);
    $banner = $DB->getOne("banner");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>


    <link href="SWFUpload/css/default.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="SWFUpload/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="SWFUpload/js/swfupload.queue.js"></script>
    <script type="text/javascript" src="SWFUpload/js/fileprogress.js"></script>
    <script type="text/javascript" src="SWFUpload/js/handlers.js"></script>
    <script type="text/javascript" src="js/Upload.js"></script>
    <script src="js/Banner.js"></script>
    <link href="CSS/style.css" rel="stylesheet" type="text/css"/>

    <script>
        var swfu;
        window.onload = function () {
            swfu = ModelUploadBanner();
            changeValue();
        };
        function fileDialogComplete() {
            swfu.startUpload();
        }
    </script>
</head>
<body>
<DIV class=main_title>添加Banner</DIV>
<table class="form">
    <tr>
        <td class="item_title">标题：</td>
        <td><input type="hidden" id="sign" name="sign"/><input type="hidden" id="id" class="id" name="id"
                                                               value="<?php
                                                               if (!empty($id)) {
                                                                   echo $id;
                                                               }?>"/><input type="text" class="title" id="title"
                                                                            name="title"
                                                                            value="<?php if (!empty($banner['title'])) {
                                                                                echo $banner['title'];
                                                                            } ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">分类：</td>
        <td>
            <input type="hidden" id="typeValue" name="typeValue" value="<?php if (!empty($banner['type'])) {
                echo $banner['type'];
            } ?>">
            <select id="type" name="type" onchange="changeType();" value="">
                <option value="1">首页</option>
                <option value="2">视频</option>
                <option value="3">优惠</option>
                <option value="4">应用</option>
            </select>
            <input type="hidden" id="subTypeValue" name="subTypeValue" value="<?php if (!empty($banner['sub_type'])) {
                echo $banner['sub_type'];
            } ?>"/>

            <div id="subType" style="display:none;">
                子分类：<select id="sub_type" name="sub_type" value="<?php if (!empty($banner['sub_type'])) {
                    echo $banner['sub_type'];
                } ?>">
                    <?php
                    if (!empty($banner['sub_type'])) {
                        ?>
                        <option value="<?php echo $banner['sub_type'] ?>"><?php
                            $DB->where("type_id", $banner['sub_type']);
                            $vType = $DB->getOne("video_type");
                            echo $vType["type_name"];
                            ?></option>
                    <?php
                    }
                    $DB->orderBy("order_id", "asc");
                    $result = $DB->get("video_type");
                    foreach ($result as $v) {
                        ?>
                        <option value="<?= $v['type_id'] ?>"><?= $v['type_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td class="item_title">展示图片地址</td>
        <td>
            <form id="form1" action="./SWFUpload/index.php" method="post" enctype="multipart/form-data">
                <div>
                    <span id="spanButtonPlaceHolder6"></span>

                    <div id="fsUploadProgress6"></div>
                    <input id="btnCancel" type="button" value="取消所有上传" onclick="swfu.cancelQueue();"
                           style="margin-left: 2px; font-size: 8pt; height: 29px;display:none;"/>
                </div>

            </form>
            <input type="text" style="display: none" id="banner"/>

            <input type="text" class="picture_url" name="picture_url" id="picture_url"
                   value="<?php if (!empty($banner['picture_url'])) {
                       echo $banner['picture_url'];
                   } ?>"/>
        </td>
    </tr>
    <tr>
        <td class="item_title">链接：</td>
        <td><input type="text" class="src" name="src" id="src" value="<?php if (!empty($banner['src'])) {
                echo $banner['src'];
            } ?>"/></td>
    </tr>
    <tr>
        <td class="item_title">绑定分类：</td>
        <td>
            <input type="hidden" id="detailsValue" name="detailsValue"
                   value="<?php echo $banner['details_type']; ?>">
            <select id="details_type" name="details_type" onchange="changeValue();" value="">
                <option value="1">活动及应用</option>
                <option value="2">视频</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="item_title">绑定标题：</td>
        <td>
            <input type="hidden" id="details_text" name="details_text" value="<?php
            if ($banner['details_type'] == "1") {
                $DB->where("id", $banner['details_id']);
                $details_text = $DB->getOne("activity");
            } else {
                $DB->where("v_id", $banner['details_id']);
                $details_text = $DB->getOne("video");
            }
            echo $details_text["title"];
            ?>"/>
            <input type="hidden" id="details_id_value" name="details_id_value"
                   value="<?php if (!empty($banner['details_id'])) {
                       echo $banner['details_id'];
                   } ?>"/>
            <select id="details_id" name="details_id" value="">
                <option value="<?php if (!empty($banner['details_id'])) {
                    echo $banner['details_id'];
                }?>">
                    <?php
                    echo $details_text["title"]?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="item_title">排序值</td>
        <td><input type="text" class="OrderID" id="order_id" name="order_id" value="<?php
            if (!empty($banner['order_id'])) {
                echo $banner['order_id'];
            } else {
                $maxOrderID = $DB->getOne("banner", "max(order_id) as maxID");
                echo $maxOrderID['maxID'] + 10;
            }
            ?>"/></td>
    </tr>
    <tr>
        <td class="item_title"></td>
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