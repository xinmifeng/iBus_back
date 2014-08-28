var GUID = "";
$(document).ready(function () {
    if ($("#detailsValue").val() != "") {
        $("#details_type").val($("#detailsValue").val())
    }
    if ($("#typeValue").val() != "") {
        $("#type").val($("#typeValue").val());
    }
    if ($("#subTypeValue").val() == 2) {
        $($("#sub_type").val($("#subTypeValue")).val());
        $("#subType").css("display", "block");
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
    var sub_type = $('#sub_type').val();
    $.ajax({
        "type": "post",
        "url": url,
        "data": {"type": type, "id": id, "title": title, "src": src, "picture_url": picture_url, "details_type": details_type, "details_id": details_id, "order_id": order_id, "sub_type": sub_type, "sign": "insert"},
        success: function (d) {
            GUID = d;
            fileDialogComplete();
        }
    });
}

function UploadData(Data) {
    $.ajax({
        "type": "post",
        "url": url,
        "data": Data,
        success: function (d) {
            console.log("这是什么东西？");
            console.log(d);
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
        "success": function (dataList) {
            var selectbox = document.getElementById("details_id");
            selectbox.length = 0;
            for (var i = 0; i < dataList.length; i++) {
                var newOption = document.createElement("option");
                newOption.appendChild(document.createTextNode(dataList[i][1]));
                newOption.setAttribute("value", dataList[i][0]);
                selectbox.appendChild(newOption);
            }


//				var e = document.getElementById("details_id");
//				alert(dataList.length)
//				for(var i=0;i<dataList.length;i++){
//					e.options= new Option(dataList[i][1],dataList[i][0]);
//				}
//
            if ($("#details_text").val() != "") {
                $("#details_id").val($("#details_id_value").val());
            }
        },
        "error": function () {
        },
        "complete": function () {
        }
    });

}

function changeType() {
    if ($("#type").val() == 2) {
        $("#subType").css("display", "block");
    } else {
        $("#subType").css("display", "none");
    }
}
