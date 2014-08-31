<?php
require_once("../MysqliDb.php");
require_once("../sqlDb.php");
require_once("../PublicAction.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>活动管理</title>
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
    <script src="../bower_components/jquery/jquery.js"></script>
    <script type="text/javascript" src="../js/layer/layer/layer.min.js"></script>
    <script type="text/javascript" src="../js/Layerutility.js"></script>
    <script type="text/javascript" src="../js/EventsManger.js"></script>
    <script type="text/javascript" src="../js/DataAction.js"></script>
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
                                            <div align="center"><img src="../images/tb.gif" width="16"
                                                                     height="16"/>
                                            </div>
                                        </td>
                                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[数据管理]->[导出数据]

                                            &nbsp;&nbsp;&nbsp;
                                            <input type="button" onclick="ExportAllData();" value="导出全部"/>
                                            <input type="button" value="导出选中值"/>
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
                                                        </div>
                                                    </td>
                                                    <td class="STYLE1">
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
                                                        <div align="center"></div>
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
                                                        <div align="center"></div>
                                                    </td>
                                                    <td class="STYLE1">
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
                            <td width="3%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center">
                                    <input type="checkbox" name="checkbox" value="checkbox"/>
                                </div>
                            </td>
                            <td width="6%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">序号</span></div>
                            </td>
                            <td width="12%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">操作位置</span></div>
                            </td>
                            <td width="14%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">操作类型</span></div>
                            </td>
                            <td width="4px" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">操作内容</span></div>
                            </td>
                            <td width="18%" height="22" background="../images/bg.gif" bgcolor="#FFFFFF">
                                <div align="center"><span class="STYLE1">操作时间</span></div>
                            </td>
                        </tr>
                        <?php

                        $DataSource = $DB->get("history");
                        for ($index = 0;
                             $index < count($DataSource);
                             $index++) {
                            ?>

                            <tr>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><input type='checkbox'/></div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center' class='STYLE1'>
                                        <div align='center' class='IndexNum'>
                                            <?php echo $index * 1 + 1 ?>
                                        </div>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'>
                                       <?php echo ResultTableDetails($DataSource[$index]["table_name"]); ?>
                                    </span>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'>
                                                <?php echo GetDoType($DataSource[$index]["action"]); ?>
                                                </span>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'>
                                                 <?php
                                                 if ($DataSource[$index]["action"] != "del") {
                                                     if ($DataSource[$index]["action"] == "add") {
                                                         echo ResultTableDetails($DataSource[$index]["table_name"]) . "表 添加了一条记录。";
                                                     } else {
                                                         echo $DataSource[$index]["modified"];
                                                     }
                                                 } else {
                                                     echo ResultTableDetails($DataSource[$index]["table_name"]) . "表 删除了一条记录。"; // $DataSource[$index]["cost"];
                                                 }
                                                 ?>
                                                </span>
                                    </div>
                                </td>
                                <td height='20' bgcolor='#FFFFFF'>
                                    <div align='center'><span
                                            class='STYLE1'> <?php echo $DataSource[$index]["action_time"]; ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }?>
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
                            <td class="STYLE4">&nbsp;&nbsp;共有 120 条记录，当前第 1 / 10 页</td>
                            <td>
                                <table border="0" align="right" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="40"><img src="../images/first.gif" width="37" height="15"/></td>
                                        <td width="45"><img src="../images/back.gif" width="43" height="15"/></td>
                                        <td width="45"><img src="../images/next.gif" width="43" height="15"/></td>
                                        <td width="40"><img src="../images/last.gif" width="37" height="15"/></td>
                                        <td width="100">
                                            <div align="center"><span class="STYLE1"> 转到第
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

