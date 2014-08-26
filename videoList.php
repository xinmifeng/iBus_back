<?php
/**
 * 视频管理.
 *
 * @author  Dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
$i = 1;
$DB->orderBy("order_id", "asc");
$result = $DB->get("video");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>
    <script src="js/VideoList.js"></script>

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
                                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[视频管理]->[视频列表]
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
                                                <tr>
                                                    <td class="STYLE1">

                                                    </td>
                                                    <td class="STYLE1">

                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="60">
                                            <table width="90%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td class="STYLE1">
                                                        <div align="center"><img src="../images/22.gif" width="14"
                                                                                 height="14"/><a href="#"
                                                                                                 onclick="to_addPage()">新增</a>
                                                        </div>
                                                    </td>
                                                    <td class="STYLE1">
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
                                                        <div align="center"><a href="#" onclick="to_delete();">删除</a>
                                                        </div>
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
                           bgcolor="b5d6e6" onmouseover="changeto()" onmouseout="changeback()">
                        <tr>
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center">
                                    <input type="checkbox" name="checkbox" value="checkbox"/>
                                </div>
                            </td>
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">序号</span></div>
                            </td>
                            <td width="10%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">标题</span></div>
                            </td>
                            <td width="5%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">所属类别</span></div>
                            </td>
                            <td width="15%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">视频名称</span></div>
                            </td>
                            <td width="15%" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">图片地址</span></div>
                            </td>
                            <td width="5%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">时长</span></div>
                            </td>
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">点赞数</span></div>
                            </td>
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">播放数</span></div>
                            </td>
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">排序值</span></div>
                            </td>
                            <td width="15%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">创建时间</span></div>
                            </td>
                            <td width="15%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF"
                                class="STYLE1">
                                <div align="center">基本操作</div>
                            </td>
                        </tr>
                        <?
                        foreach ($result as $rs) //循环
                        {
                            ?>
                            <tr>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'>
                                        <input type="checkbox" name="checkboxName" value="<?php echo $rs['v_id'] ?>"/>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center' class='STYLE1'>
                                        <div align='center' class='IndexNum'><? echo $i ?></div>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['title'] ?></span>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><?
                                            $DB->where("type_id", $rs['type_id']);
                                            $videoType = $DB->getOne("video_type");
                                            echo $videoType['type_name'];
                                            ?></span>
                                    </div>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['v_name'] ?></span>
                                    </div>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['pic_url'] ?></span>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['length'] ?></span>
                                    </div>
                                </td>

                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['total_like'] ?></span>
                                    </div>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['count'] ?></span>
                                    </div>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['order_id'] ?></span>
                                    </div>
                                </td>
                                <td bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'><? echo $rs['create_date'] ?></span>
                                    </div>
                                </td>


                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span class='STYLE4'><img src='../images/edt.gif' width='16'
                                                                                  height='16'/><a href='#'
                                                                                                  onclick='to_updatePage(<?php echo $rs['v_id'] ?>)'>编辑</a>&nbsp; &nbsp;<img
                                                src='../images/del.gif'
                                                width='16' height='16'/><a href='#'
                                                                           onclick='to_delete(<?php echo $rs['v_id'] ?>)'>删除</a></span>
                                    </div>
                                </td>
                            </tr>

                            <? $i++;
                        } ?>

                    </table>

            <tr>
            </tr>

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


</body>
</html>