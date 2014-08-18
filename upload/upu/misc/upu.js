/**
 * UGiA PHP UPLOADER V0.2
 *
 * @link        http://www.ugia.cn/
 * @copyright   Copyright: 2004-2005 UGiA.CN.
 * @author      legend <legendsky@hotmail.com>
 * @package     UPU
 * @version     $Id: upu.js,v 1.1.1.1 2005/09/21 23:48:33 legend9 Exp $
 */

var basePath  = "/upload/upu/";  //upu所在目录的绝对路径

var processID = "";
var srvHost   = "";
var srvAddr   = "";

var clientForm = null;
var realAction = "";
var formData   = "";

function upuInit(obj)
{
    clientForm = obj;

    var prowin = window.open( basePath + "progress.php?tmp=" +  Math.random(), null, "height=200,width=368,status=no,toolbar=no,menubar=no,location=no");

    var ce = document.createElement("div");
    ce.id  = "iframediv";
    ce.style.display = "none";
    document.body.appendChild(ce);

    var ce = document.createElement("iframe");
    ce.id = "frmSocket";
    ce.src = "about:blank";
    document.getElementById("iframediv").appendChild(ce);
    
    document.getElementById("iframediv").innerHTML += '<iframe src="about:blank" width="500" height="200" frameborder="1"   name="frmUpload" id="frmUpload"></iframe>';
    
    return false;
}

function setUploadServer()
{
    document.getElementById("frmSocket").src = basePath + "upload.php?processID=" + processID;
}

function upload()
{
    document.getElementById("frmSocket").src = "about:blank";
    realAction = clientForm.action;
    clientForm.target = "frmUpload"
    clientForm.action = "http://" + srvAddr;
    clientForm.submit();
}

function post()
{
    var ce = document.createElement("div");
    ce.id  = "formdiv";
    ce.style.display = "none";
    document.body.appendChild(ce);

    var ce = document.createElement("form");
    ce.id   = "tempform";
    ce.name = "tempform1";
    ce.method = "post";
    ce.action = realAction;
    document.getElementById("formdiv").appendChild(ce);
    
    var items = new Array('filename', 'clientpath', 'savepath', 'filetype', 'filesize', 'extension');
    for (var i = 0; i < formData.length; i ++)
    {
        if (formData[i][0] == "file")
        {
            for (var j = 2; j < 8; j ++)
            {
                var ce   = document.createElement("input");
                ce.name  = formData[i][1] + "[" + items[j - 2] + "]";
                ce.type  = "hidden";
                ce.value = formData[i][j];
                
                document.getElementById("tempform").appendChild(ce);
            }
        }
        else
        {
            var ce   = document.createElement("input");
            ce.name  = formData[i][1];
            ce.type  = "hidden";
            ce.value = formData[i][2];
            
            document.getElementById("tempform").appendChild(ce);         
        }
    }
   
    document.getElementById("tempform").submit();
}


function cancel()
{
    document.getElementById("frmUpload").src = "about:blank";
}