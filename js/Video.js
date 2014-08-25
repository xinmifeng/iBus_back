var url = "videoAction.php";
function insertDate() {

    var type_id = $('#type_id').val();
    var v_id = $('#v_id').val();
    var title = $('#title').val();
    var v_name = $('#v_name').val();
    var pic_url = $('#pic_url').val();
    var address = $('#address').val();
    var length = $('#length').val();
    var order_id = $('#order_id').val();
    $.ajax({
        "type": "post",
        "url": url,
        "data": {"type_id": type_id, "v_id": v_id, "title": title, "v_name": v_name, "pic_url": pic_url, "address": address, "length": length, "order_id": order_id, "sign": "insert"},
        error: function (XmlHttpRequest, textStatus, errorThrown) {
            alert(XmlHttpRequest.responseText);
        },
        success: function (d) {
            GUID = d;
            fileDialogComplete();
        }
    });
}


function Updatedata(id, UpdateData) {
    $.ajax({
        "type": "post",
        "url": url,
        "data": UpdateData,
        error: function (XmlHttpRequest, textStatus, errorThrown) {
            alert(XmlHttpRequest.responseText);
        },
        success: function (d) {
            alert("≥…π¶¡À");
        }
    });

}

function goback() {
    window.location.href = "videoList.php";
}
