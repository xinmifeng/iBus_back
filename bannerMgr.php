<?php
/**
 * banner管理.
 *
 * @author  Dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
$i = 1;
$DB->orderBy("order_id", "asc");
$result = $DB->get("banner");
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>
    <script>
        function CheckAll(val) {
            $("input[name='chkJob']").each(function () {
                this.checked = val;
            });
        }
        var highlightcolor = '#c1ebff';
        //此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(
        var clickcolor = '#51b2f6';
        function changeto() {
            source = event.srcElement;
            if (source.tagName == "TR" || source.tagName == "TABLE")
                return;
            while (source.tagName != "TD")
                source = source.parentElement;
            source = source.parentElement;
            cs = source.children;
            if (cs[1].style.backgroundColor != highlightcolor && source.id != "nc" && cs[1].style.backgroundColor != clickcolor)
                for (i = 0; i < cs.length; i++) {
                    cs[i].style.backgroundColor = highlightcolor;
                }
        }
        function changeback() {
            if (event.fromElement.contains(event.toElement) || source.contains(event.toElement) || source.id == "nc")
                return
            if (event.toElement != source && cs[1].style.backgroundColor != clickcolor)
                for (i = 0; i < cs.length; i++) {
                    cs[i].style.backgroundColor = "";
                }
        }
        function clickto() {
            source = event.srcElement;
            if (source.tagName == "TR" || source.tagName == "TABLE")
                return;
            while (source.tagName != "TD")
                source = source.parentElement;
            source = source.parentElement;
            cs = source.children;
            if (cs[1].style.backgroundColor != clickcolor && source.id != "nc")
                for (i = 0; i < cs.length; i++) {
                    cs[i].style.backgroundColor = clickcolor;
                }
            else
                for (i = 0; i < cs.length; i++) {
                    cs[i].style.backgroundColor = "";
                }
        }

    </script>
    <style type="text/css">
        <!--
        body {
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
        }

        .STYLE1 {
            font-size: 12px
        }

        .STYLE3 {
            font-size: 12px;
            font-weight: bold;
        }

        .STYLE4 {
            color: #03515d;
            font-size: 12px;
        }

        -->
    </style>
</head>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="30" background="../images/tab_05.gif">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30"/></td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="46%" valign="middle">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="5%">
                                            <div align="center"><img src="../images/tb.gif" width="16" height="16"/>
                                            </div>
                                        </td>
                                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[Banner管理]->[Banner管理]
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="54%">
                                <table border="0" align="right" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="60">
                                            <table width="87%" border="0" cellpadding="0" cellspacing="0">
                                                <tr style="display: none">
                                                    <td class="STYLE1">
                                                        <div align="center">
                                                            <input type="checkbox" name="checkbox62"
                                                                   value="checkbox"/>
                                                        </div>
                                                    </td>
                                                    <td class="STYLE1">
                                                        <div align="center">全选</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="60">
                                            <table width="90%" border="0" cellpadding="0" cellspacing="0">
                                            </table>
                                        </td>
                                        <td width="60">
                                            <table width="90%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td class="STYLE1">
                                                        <div align="center"><img src="../images/22.gif" width="14"
                                                                                 height="14"/></div>
                                                    </td>
                                                    <td class="STYLE1">
                                                        <div align="center"><a href="#" onclick="to_addPage()">新增</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="52">
                                            <table width="88%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td class="STYLE1">
                                                        <div align="center"><img src="../images/11.gif" width="14"
                                                                                 height="14"/></div>
                                                    </td>
                                                    <td class="STYLE1">
                                                        <div align="center"><a href="#" onclick="to_delete();">删除</a></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="16"><img src="../images/tab_07.gif" width="16" height="30"/></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="8" background="../images/tab_12.gif">&nbsp;</td>
                <td>
                    <table width="100%" border="0" id="ShowDataTable" cellpadding="0" cellspacing="1"
                           bgcolor="b5d6e6"
                           onmouseover="changeto()"
                           onmouseout="changeback()">
                        <tr>
                            <td width="5%" height="22" background="../images/bg.gif" class="STYLE1" bgcolor="#FFFFFF">
                                <div align="center">
                                    <input type='checkbox' id='chkAll' onclick="CheckAll(this.checked)"/>全选
                                </div>
                            </td>
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">序号</span></div>
                            </td>
                            <td width="8%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">标题</span></div>
                            </td>
                            <td width="8%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">所属类别</span></div>
                            </td>
                            <td width="8%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">子类别</span></div>
                            </td>
                            <td width="15%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">图片地址</span></div>
                            </td>
                            <td width="8%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">链接</span></div>
                            </td>
                            <td width="8%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">绑定类型</span></div>
                            </td>
                            <td width="8%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">绑定标题</span></div>
                            </td>
                            <td width="5%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">排序值</span></div>
                            </td>
                            <td width="10%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">创建时间</span></div>
                            </td>
                            <td width="23%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF"
                                class="STYLE1">
                                <div align="center">基本操作</div>
                            </td>
                        </tr>
                        <?
                        foreach ($result as $rs) //循环
                        {
                            ?>
                            <tr>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'>
                                                <input name='chkJob' type='checkbox'
                                                       value="<?php echo $rs['id'] ?>"/></span>
                                    </div>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><input type="hidden" name="id"/><? echo $i ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['title'] ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? switch ($rs['type']) {
                                                case "1":
                                                    echo "首页";
                                                    break;
                                                case "2":
                                                    echo "视频";
                                                    break;
                                                case "3":
                                                    echo "优惠";
                                                    break;
                                                case "4":
                                                    echo "应用";
                                                    break;
                                            }
                                            ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><?php    $DB->where("type_id", $rs['sub_type']);
                                            $videoType = $DB->getOne("video_type");
                                            echo $videoType['type_name'];
                                            ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['picture_url'] ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['src'] ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? switch ($rs['details_type']) {
                                                case "1":
                                                    echo "活动及应用";
                                                    break;
                                                case "2":
                                                    echo "视频";
                                                    break;
                                            }
                                            ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? if ($rs['details_type'] == "1") {
                                                $DB->where("id", $rs['details_id']);
                                                $details_text = $DB->getOne("activity");
                                            } else {
                                                $DB->where("v_id", $rs['details_id']);
                                                $details_text = $DB->getOne("video");
                                            }
                                            echo $details_text["title"];

                                            ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['order_id'] ?></span>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['create_date'] ?></span>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span class='STYLE4'><img src='../images/edt.gif' width='16'
                                                                                  height='16'/><a href='#'
                                                                                                  onclick='to_updatePage(<?php echo $rs['id'] ?>)'>编辑</a>&nbsp; &nbsp;<img
                                                src='../images/del.gif'
                                                width='16' height='16'/><a href='#'
                                                                           onclick='to_delete(<?php echo $rs['id'] ?>)'>删除</a></span>
                                    </div>
                                </td>
                            </tr>
                            <? $i++;
                        } ?>
                    </table>
                </td>
                <td width="8" background="../images/tab_15.gif">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
<tr style="display: none">
    <td height="35" background="../images/tab_19.gif">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35"/></td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="STYLE4">&nbsp;&nbsp;共有 120 条记录，当前第 1/10 页</td>
                            <td>
                                <table border="0" align="right" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="40"><img src="../images/first.gif" width="37" height="15"/></td>
                                        <td width="45"><img src="../images/back.gif" width="43" height="15"/></td>
                                        <td width="45"><img src="../images/next.gif" width="43" height="15"/></td>
                                        <td width="40"><img src="../images/last.gif" width="37" height="15"/></td>
                                        <td width="100">
                                            <div align="center"><span class="STYLE1">转到第
                    <input name="textfield" type="text" size="4"
                           style="height:12px; width:20px; border:1px solid #999999;"/>
                    页 </span></div>
                                        </td>
                                        <td width="40"><img src="../images/go.gif" width="37" height="15"/></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="16"><img src="../images/tab_20.gif" width="16" height="35"/></td>
            </tr>
        </table>
    </td>
</tr>
</table>


<script>
    var url = "bannerAction.php";
    //弹出添加页面
    function to_addPage() {
        window.location.href = "bannerAddOrUpdate.php";
    }
    //弹出修改页面
    function to_updatePage(id) {
        window.location.href = "bannerAddOrUpdate.php?id=" + id;
    }

    function insertDate(el) {
        var $table = $(el).closest("table");
        var typeName = $("input.typeName", $table).val();
        var orderID = $("input.typeOrderID", $table).val();
        var typeID = $("input.type_id", $table).val();
        $.ajax({
            "type": "post",
            "url": url,
            "data": {"typeName": typeName, "orderID": orderID, "typeID": typeID, "sign": "insert"},
            "success": function () {
                $.Show("保存成功", 1);
                $(".xubox_layer").find("#closebtn").click();
            },
            "error": function () {
            },
            "complete": function () {
            }
        });
    }

    function to_delete(id) {
        var msg = "是否确定删除？";
        var boxes = document.getElementsByName("chkJob");
        var groupTypeId = new Array();
        var h = 0;
        $.ShowAlert(msg, "确定", "取消", function () {
            if (id != undefined) {
                groupTypeId.push(id);
            } else {
                for (var g = 0; g < boxes.length; g++) {
                    if (boxes[g].checked) {
                        groupTypeId[h] = boxes[g].value;
                        h++;
                    }
                }
            }
            $.ajax({
                "type": "post",
                "url": url,
                "data": {"tids": groupTypeId, "sign": "delete"},
                success: function (data) {
                    window.location.href = "bannerMgr.php";
                }
            });
        }, function () {
        })
    }
</script>
</body>
</html>