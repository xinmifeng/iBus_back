var GUID = "";
$(document).ready(function () {
    if ($("#typeValue").val() != "") {
        $("#index_type").val($("#typeValue").val());
    }
    changeValue();
});

function insertDate() {
    var position = $('#position').val();
    var index_type = $('#index_type').val();
    var src = $('#src').val();
    var pic_url = $('#pic_url').val();
    var details_id = $('#details_id').val();
    $.ajax({
        "type": "post",
        "url": "indexAction.php",
        "data": {"position": position, "index_type": index_type, "sign": "11", "src": src, "pic_url": pic_url, "details_id": details_id},
        success: function (d) {
            fileDialogComplete();
            GUID = d;
        }
    });
}

function UpData(DataList) {
    $.ajax({
        "type": "post",
        "url": "indexAction.php",
        "data": DataList,
        success: function (d) {
            console.log(d);
        }
    });
}


function goback() {
    window.location.href = "indexMgr.php";
}
function changeValue() {
    var details_type = "";
    var position = $('#position').val();
    if (position == "2" || position == "3") {
        details_type = "2";
    } else {
        details_type = "1";
    }
    $.ajax({
        "type": "post",
        "url": "../bannerAction.php",
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

            if ($("details_id_value").val() != "") {
                $("#details_id").val($("#details_id_value").val());
            }
        }
    });
}
