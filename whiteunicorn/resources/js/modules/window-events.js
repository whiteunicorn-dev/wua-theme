//import log from "../utils/helpers/console-log";
import { $win, events } from "../utils/globals";

export default function windowEvents() {
    //-- Scroll
    var ticking = false;
    $win.on("scroll", handleScrolling);
    //events.on("scrollYChanged", function() { log("scrollY", global.scrollY); });//TESTING**
    function handleScrolling(e) {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateScrollPos();
                ticking = false;
            });
            ticking = true;
        }
    }
    function updateScrollPos() {
        var scrollTop = $win.scrollTop();
        if (global.scrollY == scrollTop) { return; }//only update if scroll position has changed
        global.scrollY = scrollTop;
        events.emit("scrollYChanged");
    }

    //-- Resize
    $win.on("resize", checkVariables);
    function checkVariables() {
        if (global.winWidth != $win.width()) {
            updateWidth();
        }
        if (global.winHeight != $win.height()) {
            updateHeight();
        }
    }
    function updateWidth() {
        global.winWidth = $win.width();
        events.emit("winWidthChange");
    }
    function updateHeight() {
        global.winHeight = $win.height();
        events.emit("winHeightChanged");
    }
  
    //-- Load
    $win.on("load", function() {
        events.emit("window_loaded");
    });
}