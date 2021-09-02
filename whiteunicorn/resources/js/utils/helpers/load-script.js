//-- Load External Script --//
export default function loadScript(url, callback = false) {
    var script = document.createElement("script");

    script.type = "text/javascript";
    //IE
    if (script.readyState){
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" || script.readyState == "complete"){
                script.onreadystatechange = null;
                onload();
            }
        };
    }
    else {
        script.onload = function(){
            onload();
        };
    }
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);

    function onload() {
        if (callback != false) { callback(); }
    }
}