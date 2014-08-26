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
require_once("./doAccess.php");
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $DB->where("id", $id);
    $banner = $DB->getOne("banner");
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>
    <script src="js/Banner.js"></script>
</head>
<body onload="changeValue();">
<form id="addForm" name="addForm" action="bannerAction.php" method="post">
    <table>
        <tr>
            <td>标题：</td>
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
            <td>分类：</td>
            <td>
                <input type="hidden" id="typeValue" name="typeValue" value="<?php if (!empty($banner['type'])) {
                    echo $banner['type'];
                } ?>">
                <select id="type" name="type" value="">
                    <option value="1">首页</option>
                    <option value="2">视频</option>
                    <option value="3">优惠</option>
                    <option value="4">应用</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>展示图片地址</td>
            <td><input type="text" class="picture_url" name="picture_url" id="picture_url"
                       value="<?php if (!empty($banner['picture_url'])) {
                           echo $banner['picture_url'];
                       } ?>"/></td>
        </tr>
        <tr>
            <td>链接：</td>
            <td><input type="text" class="src" name="src" id="src" value="<?php if (!empty($banner['src'])) {
                    echo $banner['src'];
                } ?>"/></td>
        </tr>
        <tr>
            <td>绑定分类：</td>
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
            <td>绑定标题：</td>
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
                    <option value="<?php
                    echo $banner['details_id'];?>"><?php
                        echo $details_text["title"]?></option>
                </select>
            </td>
        </tr>
        <tr>
            <td>排序值</td>
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
            <td><input type="button" name="add" value="确定" onclick="insertDate();"/><input type="button" name="back"
                                                                                           value="返回"
                                                                                           onclick="goback();"/></td>
        </tr>
    </table>
</form>
</body>
</html>