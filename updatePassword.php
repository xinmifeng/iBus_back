<?php
header("Content-Type:text/html;charset=GB2312");  ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <script src="bower_components/jquery/jquery.js"></script>
    <script src="js/layer/layer/layer.min.js"></script>
    <script src="js/Layerutility.js"></script>
	<script src="js/JunValidator/JunValidator.js"></script>
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
            <td><input id="password" type="password" maxlength="20"
				empty="false" emptymsg="原始密码不能为空" illleagle="原始密码长度为3~20" reg="pwd"  class="checkInput"
			/></td>
        </tr>
        <tr>
            <td class="item_title">新密码：</td>
            <td><input id="newpsd" type="password" maxlength="20"
				empty="false" emptymsg="新密码不能为空" illleagle="新密码长度为3~20" reg="pwd"  class="checkInput"
			/></td>
        </tr>
        <tr>
            <td class="item_title">确认新密码：</td>
            <td><input id="newpsd2" type="password" maxlength="20"
				empty="false" emptymsg="确认密码不能为空" illleagle="确认密码长度为3~20" reg="pwd"  class="checkInput"
				for="newpsd" unmatchmsg="确认密码要与新密码相同"
			/></td>
        </tr>
        <tr>
            <td class="item_title" style="text-align: left"><input type="hidden" name="flag" value="1"/>
            </td>
            <TD><input name="submit" id="btn_add" type="button" class="button" value="提交"/> <font color="red"><span
                        id="ShowMsg"></span></font>

                <p></TD>
        </tr>

    </table>
</form>
</body>
</html>
<script>
	var Regs={
		pwd:/^.{3,20}$/
	};
	$inputs=$(".checkInput");
    var validator = new JunValidator({
        "Regs": Regs,
        "elements": $inputs,
        "blurAfter": function (element, data) {
			addJunIcon(element,data);
		}
	});
	$("#btn_add").click(function(){
		if(validator && !validator.check()){
			$.Show('信息填写错误,请重新填写',2);
			return;
		}
		UpdatePsd();
	});
</script>
