var url = "videoAction.php";
//弹出添加页面
function to_addPage() {
    window.location.href = "videoAdd.php";
}
//弹出修改页面
function to_updatePage(id) {
    window.location.href = "videoAdd.php?v_id=" + id;
}

function insertDate(el) {
    var $table = $(el).closest("table");
    var typeName = $("input.typeName", $table).val();
    var orderID = $("input.typeOrderID", $table).val();
    var typeID = $("input.type_id", $table).val();
    $.ajax({
        "type": "post",
        "url": url,
        "data": {"typeName": typeName, "orderID": orderID, "typeID": typeID, "sign": "insert"},
        "success": function () {
            $.Show("保存成功", 1);
            $(".xubox_layer").find("#closebtn").click();
        },
        "error": function () {
        },
        "complete": function () {
        }
    });
}

function to_delete(id) {
    var msg = "是否确定删除？";
    $.ShowAlert(msg, "确定", "取消", function () {
        var groupTypeId = new Array();
        if (id != undefined) {
            groupTypeId.push(id);
        } else {
            var boxes = document.getElementsByName("checkboxName");
            var h = 0;
            for (var g = 0; g < boxes.length; g++) {
                if (boxes[g].checked) {
                    groupTypeId[h] = boxes[g].value;
                    h++;
                }
            }
        }
        $.ajax({
            "type": "post",
            "url": url,
            "data": {"tids": groupTypeId, "sign": "delete"},
            success: function (data) {
                console.log(data);
                window.location.href = "videoList.php";
            }
        });
    }, function () {
    })
}


var clickcolor = '#51b2f6';
var highlightcolor = '#c1ebff';
function changeto() {
    source = event.srcElement;
    if (source.tagName == "TR" || source.tagName == "TABLE")
        return;
    while (source.tagName != "TD")
        source = source.parentElement;
    source = source.parentElement;
    cs = source.children;
    if (cs[1].style.backgroundColor != highlightcolor && source.id != "nc" && cs[1].style.backgroundColor != clickcolor)
        for (i = 0; i < cs.length; i++) {
            cs[i].style.backgroundColor = highlightcolor;
        }
}
function changeback() {
    if (event.fromElement.contains(event.toElement) || source.contains(event.toElement) || source.id == "nc")
        return
    if (event.toElement != source && cs[1].style.backgroundColor != clickcolor)
        for (i = 0; i < cs.length; i++) {
            cs[i].style.backgroundColor = "";
        }
}
function clickto() {
    source = event.srcElement;
    if (source.tagName == "TR" || source.tagName == "TABLE")
        return;
    while (source.tagName != "TD")
        source = source.parentElement;
    source = source.parentElement;
    cs = source.children;
    if (cs[1].style.backgroundColor != clickcolor && source.id != "nc")
        for (i = 0; i < cs.length; i++) {
            cs[i].style.backgroundColor = clickcolor;
        }
    else
        for (i = 0; i < cs.length; i++) {
            cs[i].style.backgroundColor = "";
        }
}
