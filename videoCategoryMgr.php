<?php
/**
 * 视频分类管理.
 *
 * @author  Dennis
 * @version 1.0
 * @package main
 */
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
$i = 1;
$DB->orderBy("order_id", "asc");
$result = $DB->get("video_type");
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>
    <script src="js/CategoryMgr.js"></script>
	<script src="js/JunValidator/JunValidator.js"></script>
    <link href="CSS/style.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div style="display:none" id="DIV_Event">
    <form name="addForm" action="videoCategoryAction.php" method="post">
        <table class="form">
            <tr>
                <td class="item_title">视频分类名称：</td>
                <td style="width:350px;"><input type="hidden" id="type_id" class="type_id" name="type_id"/>
				<input type="text" class="typeName checkInput" 
				empty="false" emptymsg="名称不能为空" illleagle="分类名称长度为1~10" reg="title"  
				id="type_name"/></td>
            </tr>
            <tr>
                <td class="item_title">排序值</td>
                <td><input type="text" class="typeOrderID checkInput" id="type_order_id" name="type_order_id" 
				empty="false" emptymsg="排序值不能为空" illleagle="排序值为数字" reg="num"  
				value="<?php
                    $maxOrderID = $DB->getOne("video_type", "max(order_id) as maxID");
                    echo $maxOrderID['maxID'] + 10;
                    ?>"/></td>
            </tr>
            <tr>
                <td class="item_title"></td>
                <td><input type="button" name="add" onclick="doInsert()" id="BtnSave" value="确定" class="button" /><input
                        type="button"
                        id="closebtn"
                        value="关闭" class="button"/></td>
            </tr>
        </table>
    </form>
</div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="30" background="images/tab_05.gif">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30"/></td>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="46%" valign="middle">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="5%">
                                                <div align="center"><img src="images/tb.gif" width="16" height="16"/>
                                                </div>
                                            </td>
                                            <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[视频管理]->[视频类型管理]
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="54%">
                                    <table border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="60">
                                                <table width="87%" border="0" cellpadding="0" cellspacing="0">
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

                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="60">
                                                <table width="90%" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td class="STYLE1">
                                                            <div align="center"><img src="images/22.gif" width="14"
                                                                                     height="14"/></div>
                                                        </td>
                                                        <td class="STYLE1">
                                                            <div align="center"><a href="#"
                                                                                   onclick="to_addPage();">新增</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="52">
                                                <table width="88%" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td class="STYLE1">
                                                            <div align="center"><img src="images/11.gif" width="14"
                                                                                     height="14"/></div>
                                                        </td>
                                                        <td class="STYLE1">
                                                            <div align="center"><a href="#"
                                                                                   onclick="to_delete();">删除</a></div>
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
                    <td width="16"><img src="images/tab_07.gif" width="16" height="30"/></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="8" background="images/tab_12.gif">&nbsp;</td>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6"
                               onmouseover="changeto()"
                               onmouseout="changeback()">
                            <tr>
                                <td width="3%" height="22" background="images/bg.gif" bgcolor="#FFFFFF">
                                    <div align="center">
                                        <input type="checkbox" name="checkbox" value="checkbox"/>
                                    </div>
                                </td>
                                <td width="3%" height="22" background="images/bg.gif" bgcolor="#FFFFFF">
                                    <div align="center"><span class="STYLE1">序号</span></div>
                                </td>
                                <td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF">
                                    <div align="center"><span class="STYLE1">类别名称</span></div>
                                </td>
                                <td width="14%" height="22" background="images/bg.gif" bgcolor="#FFFFFF">
                                    <div align="center"><span class="STYLE1">排序值</span></div>
                                </td>
                                <td width="18%" background="images/bg.gif" bgcolor="#FFFFFF">
                                    <div align="center"><span class="STYLE1">创建时间</span></div>
                                </td>
                                <td width="15%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">
                                    <div align="center">基本操作</div>
                                </td>
                            </tr>
                            <?
                            foreach ($result as $rs) //循环
                            {
                                ?>
                                <tr>
                                    <td height="20" bgcolor="#FFFFFF">
                                        <div align="center">
                                            <input type="checkbox" name="checkboxName"
                                                   value="<?php echo $rs['type_id'] ?>"/>
                                        </div>
                                    </td>
                                    <td height="20" bgcolor="#FFFFFF">
                                        <div align="center"><span class="STYLE1"><input type="hidden"
                                                                                        id="type_id"/><? echo $i ?></span>
                                        </div>
                                    </td>
                                    <td height="20" bgcolor="#FFFFFF">
                                        <div align="center"><span class="STYLE1"><? echo $rs['type_name'] ?></span>
                                        </div>
                                    </td>
                                    <td height="20" bgcolor="#FFFFFF">
                                        <div align="center"><span class="STYLE1"><? echo $rs['order_id'] ?></span></div>
                                    </td>
                                    <td height="20" bgcolor="#FFFFFF">
                                        <div align="center"><span class="STYLE1"><? echo $rs['create_date'] ?></span>
                                        </div>
                                    </td>
                                    <td height="20" bgcolor="#FFFFFF">
                                        <div align="center"><span class="STYLE4"><img src="images/edt.gif" width="16"
                                                                                      height="16"/><a href="#"
                                                                                                      onclick="to_updatePage(<?php echo $rs['type_id'] ?>);">编辑</a>&nbsp; &nbsp;<img
                                                    src="images/del.gif" width="16" height="16"/><a href="#"
                                                                                                    onclick="to_delete(<?php echo $rs['type_id'] ?>);">删除</a></span>
                                        </div>
                                    </td>
                                </tr>

                                <? $i++;
                            } ?>
                        </table>
                    </td>
                    <td width="8" background="images/tab_15.gif">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="display: none">
        <td height="35" background="images/tab_19.gif">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="12" height="35"><img src="images/tab_18.gif" width="12" height="35"/></td>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="STYLE4">&nbsp;&nbsp;共有 120 条记录，当前第 1/10 页</td>
                                <td>
                                    <table border="0" align="right" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="40"><img src="images/first.gif" width="37" height="15"/></td>
                                            <td width="45"><img src="images/back.gif" width="43" height="15"/></td>
                                            <td width="45"><img src="images/next.gif" width="43" height="15"/></td>
                                            <td width="40"><img src="images/last.gif" width="37" height="15"/></td>
                                            <td width="100">
                                                <div align="center"><span class="STYLE1">转到第
                    <input name="textfield" type="text" size="4"
                           style="height:12px; width:20px; border:1px solid #999999;"/>
                    页 </span></div>
                                            </td>
                                            <td width="40"><img src="images/go.gif" width="37" height="15"/></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="16"><img src="images/tab_20.gif" width="16" height="35"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
<script>
	var doInsert;
	function doCheck($el){
		var Regs={
			title:/^.{1,10}$/,
			num:/^\d{1,4}$/
		};
		$inputs=$(".checkInput",$el);
		var validator = new JunValidator({
			"Regs": Regs,
			"elements": $inputs,
			"blurAfter": function (element, data) {
				addJunIcon(element,data,'js/JunValidator/reg_ok.png');
			}
		});
		doInsert=function(){
			insertDate(validator,$el);
		}
	}
</script>
