jQuery.extend({
    /*
     *弹出框
     * msg 显示的内容
     * type 显示的图标类型
     */
    Show: function (msg, type) {
        layer.alert(msg, type);
    },
    /*
     *弹出确认框
     * msgInfo 弹出框显示的文字
     * btn1Ok显示的名字 btn2是取消显示的名字
     * funOK确认的执行的函数
     * funcancel取消执行的函数
     */
    ShowAlert: function (msgInfo, btn1, btn2, funOK, funCancel) {
        var i = $.layer({
            shade: [0],
            area: ['250px', '130px'],
            dialog: {
                msg: msgInfo,
                btns: 2,
                type: 4,
                btn: [btn1, btn2],
                yes: function () {
                    funOK();
                }, no: function () {
                    funCancel();
                }
            }
        });
    },

    ShowHtmlByForm: function (htmlStr, titleStr) {
        var html = "暂无信息!";
        if (htmlStr != "" && htmlStr != undefined) {
            html = htmlStr;
        }
        var i = $.layer({
            type: 1,
            title: titleStr,
            area: ['700px', '500px'],
            page: {html: html},
            success: function (index) {
                CloseBtn(index);
            }
        });

        function CloseBtn(index) {
            $(index).find("#closebtn").one('click', function () {
                layer.close(i);
            })
        }
    }
})
