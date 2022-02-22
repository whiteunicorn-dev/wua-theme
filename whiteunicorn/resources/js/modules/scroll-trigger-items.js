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
// With javascript
$("h2").each(function() {
    $(this).attr("data-scrolltrigger", '{ "animation":"fadeIn.fromLeft", "duration":"2","start":"top 80%", "markers": "true" }');
});

// Or directly on the element
<div class="sm-item" data-scrolltrigger='{ "animation":"fadeIn", "duration":"2","start":"top 80%", "target":".section__col", "trigger":".section__content", "stagger":".35", "clearProps":"true", "markers": "false" }'></div>

//Split Text Example
$headings.attr("data-scrolltrigger", '{ "animation":"fadeIn.fromBottom", "duration":"1", "start":"top 80%", "markers": "true", "trigger":"$this", "target":".word", "stagger":".1", "splittext":"{ type:`words`,target:`$this`, wrapWords:true }" }');
*/