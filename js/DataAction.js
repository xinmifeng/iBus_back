function ExportAllData() {
    $.ajax({
        "type": "get",
        "url": "DataAction.php",
        "data": {"Export": "all"},
        success: function (res) {
           location.href=res;
           document.execCommand('SaveAs');
        }
    });
}