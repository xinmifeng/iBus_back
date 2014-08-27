<?php
header("Content-Type:text/html;charset=GB2312");  ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <script src="bower_components/jquery/jquery.js"></script>
    <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
    <script>
        function UpdatePsd() {
            var json = {"password": $("#password").val(), "newpsd": $("#newpsd").val(), "newpsd2": $("#newpsd2").val()};
            $.ajax({
                type: "post",
                dataType: "html",
                data: json,
                url: "./Upd.php?time=" + (new Date().getTime()),
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    alert(XmlHttpRequest.responseText);
                },
                success: function (d) {
                    console.log(d);
                    $("#ShowMsg").html(d);
                }
            });
        }
    </script>
</head>
<body>
<form name="myForm" action="updatePassword.php" method="post">
    <DIV class=main_title>修改密码</DIV>
    <table class="form">
        <tr>
            <td class="item_title">原始密码：</td>
            <td><input id="password" type="password" maxlength="20"/></td>
        </tr>
        <tr>
            <td class="item_title">新密码：</td>
            <td><input id="newpsd" type="password" maxlength="20"/></td>
        </tr>
        <tr>
            <td class="item_title">确认新密码：</td>
            <td><input id="newpsd2" type="password" maxlength="20"/></td>
        </tr>
        <tr>
            <td class="item_title" style="text-align: left"><input type="hidden" name="flag" value="1"/>
            </td>
            <TD><input name="submit" type="button" class="button" onclick="UpdatePsd();" value="提交"/> <font color="red"><span
                        id="ShowMsg"></span></font>

                <p></TD>
        </tr>

    </table>
</form>
</body>
</html>