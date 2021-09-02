//import log from "../utils/helpers/console-log";
import { $doc, $win, $body } from "../utils/globals";

export default function modalTrigger() {
    var $modal = $(".modal");
    
    $modal.appendTo($body);
    $doc.on("click", ".js-modal-trigger", openModal);
    $doc.on("click", ".modal .close-btn", closeModal);
    $win.on("resize", closeModal);
    
    function openModal() {
        var $target = $(`.modal${$(this).attr("data-target")}`);
        if (!$target.length) { cl(`no modal target: ${$(this).attr("data-target")}`); return; }
            
        $target.addClass("open");
        $body.addClass("modal-open");
        $.scrollLock(true);
    }
    function closeModal() {
        $(".modal").removeClass("open");
        $body.removeClass("modal-open");
        $.scrollLock(false);
    }
}