/**
 * Use when you need to load jQuery
 * @param {fn} onload (function to run after jQuery is loaded)
 */

export default function reqJquery(onload) {
    if(typeof jQuery === 'undefined' || (parseInt(jQuery.fn.jquery) === 1 && parseFloat(jQuery.fn.jquery.replace(/^1\./,'')) < 10)) {
        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('script');
        script.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js';;
        script.type = 'text/javascript';
        script.onload = script.onreadystatechange = function() {
            if (script.readyState) {
                if (script.readyState === 'complete' || script.readyState === 'loaded') {
                script.onreadystatechange = null;
                onload(jQuery.noConflict(true));
                }
            }
            else {
                onload(jQuery.noConflict(true));
            }
        };
        head.appendChild(script);
    }
    else {
      onload(jQuery);
    }
}


/**
 * Example
 * 
let $ = null;
let $doc = null;

if (document.readyState === "complete" || document.readyState === "interactive") {
    // call on next available tick
  	setTimeout(() => { reqJquery(init); }, 1);
} else {
    document.addEventListener("DOMContentLoaded", () => reqJquery(init) );
}

function init(jQuery) {
	$ = jQuery;
  	$doc = $(document);
    //Functions that need jQuery
  	formAJAX();
}
function formAjax() {
    //can now use jQuery aka "$"
}

*/
