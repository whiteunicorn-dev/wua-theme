//-- Load External Stylesheet --//
export default function loadStyle(url, callback = false) {
    var style = document.createElement("link");

    style.rel = "stylesheet";
    //IE
    if (style.readyState){
        style.onreadystatechange = function(){
            if (style.readyState == "loaded" || style.readyState == "complete"){
                style.onreadystatechange = null;
                onload();
            }
        };
    }
    else {
        style.onload = function(){
            onload();
        };
    }
    style.href = url;
    document.getElementsByTagName("head")[0].appendChild(style);

    function onload() {
        if (callback != false) { callback(); }
    } 
}