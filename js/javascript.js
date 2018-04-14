function getObj(obj) {
    if (typeof obj == 'object')
        return obj;
    else
        obj = document.getElementById(obj);
    return obj;
}

function ajaxRequest() {
    try {
        var request = new XMLHttpRequest();
    }
    catch (e1) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e2) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e3) {
                request = false;
            }
        }
    }
    return request;
}

function checkUser(user, vari, action) {
    var obj = getObj('info');
    if (user.value == "") {
        obj.innerHTML == ""
    }
    var parm = vari + "=" + user.value;
    var request = ajaxRequest();
    request.open("POST", action, true);
    request.setRequestHeader("Content-type", "application/X-www-form-urlencoded");
    request.setRequestHeader("Content-length", parm.length);
    request.setRequestHeader("Connection", "close");
    request.onreadystatechange = function{
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText)
                    obj.innerHTML = this.responseText;
    }
    request.send(parm);
}
