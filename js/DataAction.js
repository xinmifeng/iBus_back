function ExportAllData() {
    $.ajax({
        "type": "get",
        "url": "DataAction.php",
        "data": {"Export": "all"},
        success: function (res) {
           location.href="download.php?img="+res;
            console.log(res);
        }
    });
}