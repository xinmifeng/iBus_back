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
	<script src="../js/JunValidator/JunValidator.js"></script>


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
            <td>
				<input type="text" id="hd_title" empty="false"  class="checkInput"
				emptymsg="标题不能为空" illleagle="标题长度为1~20" reg="title" />  
			</td>
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
            <td><input type="text" empty="true"  class="checkInput"
			emptymsg="外部链接不能为空" illleagle="请输入有效的http或https链接" reg="url" 
			id="hd_src"/>(无外链可忽略)</td>
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
            <td class="item_title">
            </td>
            <td><input type="button" id="btn_add" value="提交" class="button SaveChange" />
			<input type="button" class="button" value="返回" onclick="location.href='EventsManger.php'" id="closebtn"/>
            </td>
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
            <td><input type="hidden" id="updateId" value="<?php echo $id ?>" ><input class="checkInput" type="text" id="hd_title" 
				empty="false" emptymsg="标题不能为空" illleagle="标题长度为1~20" reg="title" 
			value="<?php echo iconv('UTF-8', 'GB2312', $title) ?>"/></td>
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
            <td><input class="checkInput" type="text" id="hd_src" 
			empty="true" emptymsg="外部链接不能为空" illleagle="请输入有效的http或https链接" reg="url"
			value="<?php echo iconv('UTF-8', 'GB2312', $web_url) ?>"/>(无外链可忽略)</td>
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
            <td class="item_title">
            </td>
            <td><input type="button" id="btn_update" value="提交" class="button SaveChange"/>
			<input type="button" class="button" value="返回"  onclick="location.href='EventsManger.php'" id="closebtn"/>
            </td>
        </tr>
    <?php } ?>
</table>
</div>
</body>
</html>
<script>
	var Regs={
		title:/^\w{1,20}$/,
		url:/^(http:\/\/|https:\/\/)/
	};
	$inputs=$(".checkInput");
    var validator = new JunValidator({
        "Regs": Regs,
        "elements": $inputs,
        "blurAfter": function (element, data) {
			addJunIcon(element,data,"../js/JunValidator/reg_ok.png");
		}
	});
	$("#btn_add").click(function(){
		if(!validator.check()){
			$.Show("信息填写错误,请重新填写!",2);
			return;
		}
		SubmitToAction();
	});

	$("#btn_update").click(function(){
		if(!validator.check()){
			$.Show("信息填写错误,请重新填写!",2);
			return;
		}
		var id=$("#updateId").val();
		ExecuteUpdate(id);
	});

</script>
