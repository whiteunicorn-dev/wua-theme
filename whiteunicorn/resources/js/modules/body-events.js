//import log from "../utils/helpers/console-log";
import { $body, events } from "../utils/globals";

export default function bodyEvents() {
    var atTopVal = 0,
        lastScrollY = global.scrollY;

    setup();
    events.on("scrollYChanged", updateScrollClasses);

    function setup() {
         //== Initial setup
        (global.scrollY <= atTopVal) ? $body.addClass("at-top") : $body.removeClass("at-top");
        ((global.scrollY + global.winHeight) == global.docHeight) ? $body.addClass("at-bottom") : $body.removeClass("at-bottom");
        $body.addClass("ready");
        events.emit("siteReady");
    }
    function updateScrollClasses() {
        //If scrolling up or down
        (lastScrollY > global.scrollY) ? $body.removeClass("scrolling-down").addClass("scrolling-up") : $body.addClass("scrolling-down").removeClass("scrolling-up");
        //If at top of page
        (global.scrollY <= atTopVal) ? ($body.removeClass("scrolling-down").removeClass("scrolling-up").addClass("at-top"), events.emit("body_at_top")) : $body.removeClass("at-top");
        //If at bottom of page
        ((global.scrollY + global.winHeight + 1) >= global.docHeight) ? ($body.addClass("at-bottom"), events.emit("body_at_bottom")) : $body.removeClass("at-bottom");//log("scrollTop + windowHeight:", (scrollTop + global.winHeight + 1))
        //Update lastScrollY var
        lastScrollY = global.scrollY;
    }
}