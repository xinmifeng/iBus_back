<link href="images/skin.css" rel="stylesheet" type="text/css"/>
<script src="bower_components/jquery/jquery.js"></script>
<script type="text/javascript" src="bower_components/layer/layer/layer.min.js"></script>
<script type="text/javascript" src="js/Layerutility.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<script type="text/javascript" language="JavaScript">
    function Test() {
        $.ShowAlert("您觉得对么？", "对", "错", function (i) {
            console.log(i);
            layer.msg('确定', 1, 1);
            layer.close(i);
        }, function () {
            layer.msg('取消', 1, 1);
        })
    }

    function test2() {
        $.Show("保存成功", 1);


    }
</script>

<style type="text/css">
    <!--
    html, body {
        height: 100%
    }

    body {
        margin-left: 0px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        background-color: #EEF2FB;
    }

    -->
</style>
<body>
<input type="button" value="点我" onclick="test2();"/>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17"
                                                                         height="29"/></td>
    <td valign="top" background="images/content-bg.gif">
        <table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
            <tr>
                <td height="31">
                    <div class="titlebt"><?
                        if (!isset($_GET["name"])) {
                            echo "首页";
                        } else {
                            echo $_GET["name"];
                        }
                        ?></div>
                </td>
            </tr>
        </table>
    </td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16"
                                                                          height="29"/>
    </td>
</tr>
<td valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
<td valign="top" bgcolor="#F7F8F9">



<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

</table>
</td>

</table>
</body>

