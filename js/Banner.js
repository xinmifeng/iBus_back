$(document).ready(function () {
    if ($("#detailsValue").val() != "") {
        $("#details_type").val($("#detailsValue").val())
    }
    if ($("#typeValue").val() != "") {
        $("#type").val($("#typeValue").val())
    }
});

var url = "bannerAction.php";
function insertDate() {

    var type = $('#type').val();
    var id = $('#id').val();
    var title = $('#title').val();
    var src = $('#src').val();
    var picture_url = $('#picture_url').val();
    var details_type = $('#details_type').val();
    var details_id = $('#details_id').val();
    var order_id = $('#order_id').val();
    $.ajax({
        "type": "post",
        "url": url,
        "data": {"type": type, "id": id, "title": title, "src": src, "picture_url": picture_url, "details_type": details_type, "details_id": details_id, "order_id": order_id, "sign": "insert"},
        success: function () {
            // $.Show("保存成功", 1);
            window.location.href = "bannerMgr.php";
        }
    });
}
function goback() {
    window.location.href = "bannerMgr.php";
}
function changeValue() {
    var details_type = $("#details_type").val();
    $.ajax({
        "type": "post",
        "url": url,
        "data": {"details_type": details_type, "sign": "select"},
        success: function (dataList) {
            var selectbox = document.getElementById("details_id");
            selectbox.length = 0;
            for (var i = 0; i < dataList.length; i++) {
                var newOption = document.createElement("option");
                newOption.appendChild(document.createTextNode(dataList[i][1]));
                newOption.setAttribute("value", dataList[i][0]);
                selectbox.appendChild(newOption);
            }
            if ($("#details_text").val() != "") {
                $("#details_id").val($("#details_id_value").val());
            }
        }
    });

}
