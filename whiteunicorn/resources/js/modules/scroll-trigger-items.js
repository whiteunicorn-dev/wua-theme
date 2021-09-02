//import log from "../utils/helpers/console-log";
import { $main } from "../utils/globals";
import setScrollTrigger from "../utils/helpers/gsap-scrolltrigger";

export default function scrollTriggerAnimation() { //Use with gsap
    var $items = $main.find(`[data-scrolltrigger]`);
        
    $items.each(setScrollTrigger);
}

/*
 * Example
 *

$("h2").each(function() {
    $(this).attr("data-scrolltrigger", '{ "animation":"fadeIn.fromLeft", "duration":"2","start":"top 80%", "markers": "true" }');
});

*/