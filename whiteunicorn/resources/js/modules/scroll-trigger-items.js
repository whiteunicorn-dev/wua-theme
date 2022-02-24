//import log from "../utils/helpers/console-log";
import { $main } from "../utils/globals";
import setScrollTrigger from "../utils/helpers/gsap-scrolltrigger";

export default function scrollTriggerAnimation() { //Use with gsap
    var $items = $main.find(`[data-scrolltrigger]`);
        
    $items.each(setScrollTrigger);
}

/*
 * Examples
 *
// With javascript
$("h2").each(function() {
    $(this).attr("data-scrolltrigger", '{ "animation":"fadeIn.fromLeft", "duration":"2","start":"top 80%", "markers": "true" }');
});

// Or directly on the element
<div class="sm-item" data-scrolltrigger='{ "animation":"fadeIn", "duration":"2","start":"top 80%", "target":".section__col", "trigger":".section__content", "stagger":".35", "clearProps":"true", "markers": "false" }'></div>

//Split Text Example
$headings.attr("data-scrolltrigger", '{ "animation":"fadeIn.fromBottom", "duration":"1", "start":"top 80%", "markers": "true", "trigger":"$this", "target":".word", "stagger":".1", "splittext":"{ type:`words`,target:`$this`, wrapWords:true }" }');

//On Complete Example (NOTE: This example uses `` around the data-scrolltrigger object compared to '' like the examples above. Both ways should work)
function featuredProducts() {
    var $sec = $main.find(".section-featured-products");
    
    //MOBILE
    if (mq("(max-width: 1023px)")) {
        $sec.find(".product-item")
            .attr("data-scrolltrigger",`{
                "animation": "fadeIn.fromBottom",
                "distance": "20%",
                "duration": "1.5",
                "start": "top 70%",
                "clearProps": "false",
                "onComplete": "$this.closest('.shopify-section').addClass('animation-complete');",
                "target": "picture.product-item__image img"
            }`);
    }
    //DESKTOP
    else {
        $sec
            .attr("data-scrolltrigger",`{
                "animation": "fadeIn.fromBottom",
                "distance": "20%",
                "duration": "1.5",
                "start": "top 70%",
                "clearProps": "false",
                "onComplete": "$this.closest('.shopify-section').addClass('animation-complete');",
                "target": ".img-cnt",
                "stagger": "0.15"
            }`);
    }
}
function subscribe() {
    var $sec = $main.find(".section-subscribe");
    
    $sec
    .attr("data-scrolltrigger", `{
                "animation": "fadeIn.fromBottom",
                "distance": "30%",
                "duration": ".5",
                "splittext": "{target: '.section__title', type: 'lines', lineWrap: true}",
                "stagger": "0.15",
                "target": ".line"
            }`
    );
}

*/