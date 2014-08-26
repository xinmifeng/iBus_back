<?php
require_once("./MysqliDb.php");
require_once("./sqlDb.php");
require_once("./doAccess.php");
$error_info = "";
if (!empty($_POST["password"])) {
    if (!empty($_POST["newpsd"]) && !empty($_POST["newpsd2"])) {
        if ($_POST["newpsd"] != $_POST["newpsd2"]) {
            $error_info = "两次密码填写不一致，请重新填写";
        }
        $password = $_POST["password"];
        $newpsd = $_POST["newpsd"];
        $DB->where("id", $admin['id'])
            ->where("password", md5($password));
        $Data = $DB->get("system_user");
        if (count($Data) > 0) {
            $upData = Array(
                'password' => md5($newpsd),
            );
            $DB->where("id", $admin['id']);
            $cnt = $DB->update("system_user", $upData);
            if (count($DB) < 0) {
                $error_info = "修改失败";
            } else {
                $error_info = "修改成功！";
            }
        } else {
            $error_info = "密码错误，请重新输入";
        }
    } else {
        $error_info = "请填写新密码和确认密码";
    }
} else {
    $error_info = "请输入原始密码";
}
echo $error_info;
?>