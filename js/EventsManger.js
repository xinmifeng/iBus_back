var highlightcolor = '#c1ebff';
//�˴�clickcolorֻ����winϵͳ��ɫ������ܳɹ�,�����#xxxxxx�Ĵ���Ͳ���,��û�����Ϊʲô:(
var clickcolor = '#51b2f6';
var GUID = "";
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


//�������ҳ��
function AddEvents() {
    location.href = "Add.php?type=add";
}
///��ӻ
function SubmitToAction() {
    $AppType = 0;
    if ($("#Sel_type").val() == "Ӧ�ã���Ϸ��") {
        $AppType = 1;
    }
    if ($("#Sel_type").val() == "Ӧ�ã�App��") {
        $AppType = 2;
    }

    var jsonStr = {"hd_title": $("#hd_title").val(), "hd_type": $("#Sel_type").val(), "hd_webUrl": $("#hd_src").val(), "hd_apptype": $AppType};
    $.ajax({
        type: "get",
        dataType: "html",
        data: jsonStr,
        url: "../doAction.php?sign=Event_HD&time=" + (new Date().getTime()),
        error: function (XmlHttpRequest, textStatus, errorThrown) {
            alert(XmlHttpRequest.responseText);
        },
        success: function (d) {
            if (d > 0) {
                GUID = d;
                fileDialogComplete();
            }
        }
    });
}
//�������ķ���
function SortNumber(type, id) {
    if (type != undefined) {
        $("#ShowDataTable").find("tr").each(function (i) {
            if (i > id) {
                var indexval = $(this).find("td").eq(1).find(".IndexNum").text();
                indexval = indexval * 1 - 1;
                $(this).find("td").eq(1).find(".IndexNum").text(indexval);
            }
        });
    } else {
        $("#ShowDataTable").find("tr").each(function (i) {
            if (i > 1) {
                var indexval = $(this).find("td").eq(1).find(".IndexNum").text();
                indexval = indexval * 1 + 1;
                $(this).find("td").eq(1).find(".IndexNum").text(indexval);
            }
        });
    }
}
///�������׷����
function addTr(trHtml) {
    var $tr = $("#ShowDataTable tr").eq(0);
    if ($tr.size() == 0) {
        $("#ShowDataTable").after(trHtml);
    }
    $tr.after(trHtml);
}

///Ĭ�ϼ�������
function SearchToAction() {
    var jsonStr = {"hd_title": "aaa"};
    $.ajax({
        type: "get",
        dataType: "html",
        data: jsonStr,
        url: "../doAction.php?sign=Event_HD_Search&time=" + (new Date().getTime()),
        error: function (XmlHttpRequest, textStatus, errorThrown) {
            alert(XmlHttpRequest.responseText);
        },
        success: function (d) {
            if (d != "") {
                addTr(d);
            }
        }
    });
}

function ajaxDel(id, num) {
    var jsonStr = {"id": id};
    $.ajax({
        type: "get",
        dataType: "html",
        data: jsonStr,
        url: "../doAction.php?sign=Del&time=" + (new Date().getTime()),
        error: function (XmlHttpRequest, textStatus, errorThrown) {
            alert(XmlHttpRequest.responseText);
        },
        success: function (d) {
            $("#ShowDataTable").find("tr").each(function () {
                var indexval = $(this).find("td").eq(1).find(".IndexNum").text();
                if (indexval >= 1) {
                    $(this).remove();
                }
            });
            $("#ShowDataTable tr").after(d);
        }
    });
}

///ɾ�����ݵķ���
function Del_HD(id, num) {
    $.Show("fdasf", 1);
    $.ShowAlert("��ȷ��ɾ����ǰ��¼?", "ȷ��", "ȡ��", function () {
        ajaxDel(id, num);
        $(".xubox_no").click();
    }, function () {
    })
}

///չʾ�޸ĵ�����
function UpdateShow_HD(id) {
    location.href = "add.php?id=" + id;
}
//ҳ���޸���ں���
function ExecuteUpdate(id) {
    GUID = id;
    $AppType = 0;
    if ($("#Sel_type").val() == "Ӧ�ã���Ϸ��") {
        $AppType = 1;
    }
    if ($("#Sel_type").val() == "Ӧ�ã�App��") {
        $AppType = 2;
    }
    var jsonStr = {"title": $("#hd_title").val(), "type": $("#Sel_type").val(), "web_Url": $("#hd_src").val(), "app_type": $AppType};
    var jsonStr = {"UData": jsonStr, "id": id};
    update_HD(id, jsonStr);
}


function update_HD(id, paraJson) {
    $.ajax({
        type: "get",
        dataType: "html",
        data: paraJson,
        url: "../doAction.php?sign=ExecUpdate&time=" + (new Date().getTime()),
        error: function (XmlHttpRequest, textStatus, errorThrown) {
            alert(XmlHttpRequest.responseText);
        },
        success: function (d) {
            console.log(d);
            if (d > 0) {
                fileDialogComplete();
                $.Show("����ɹ�", 1);
            }
        }
    });
}



