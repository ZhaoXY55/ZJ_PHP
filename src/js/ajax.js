(function () {
    function zajax(ajax) {
        var xhr = new XMLHttpRequest();
        if(ajax.data!=undefined && Object.keys(ajax.data).length!=0){
            var paramStr = "?";
            var keys = Object.keys(ajax.data);
            var values = Object.values(ajax.data);
            for(let i=0; i<keys.length; i++){
                paramStr += `${keys[i]}=${values[i]}`;
                paramStr += "&";
            }
            paramStr = paramStr.substring(0, paramStr.length-1);
            //拼接url
            ajax.url += paramStr;
        }
        xhr.open(ajax.type, ajax.url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(ajax.send);
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    ajax.success(xhr.responseText);
                }
            }
        };
    }
    window.$ajax = zajax;
})();