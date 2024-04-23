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
$headings.attr("data-scrolltrigger", '{ "animation":"fadeIn.fromBottom", "duration":"1", "start":"top 80%", "markers": "true", "trigger":"$this", "target":".word", "stagger":".1", "splittext":"{ type:`words`,target:`$this`, wrapWords:true, revert:true }" }');

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


/**
 * More Examples
 */
function commonStaggerItems() {
    const items = [
        // Single target example (no columns). No need for delayFn and stagger can be set to 0. The scroll trigger is set to "$this" which is referring to "header.section__head"
        // This is also a split text example, the text container is "header.section__head" and the target to setup the split text is the `h2` element and the type is set to `lines` which setup the p into lines (with the class of .line)
        // The target for the animations is the .line element (the .line element will be created when the split text is initiated)
        // NOTE: Set "markers" : true  to see scroll trigger markers
        { // NOTE: This example is on the homepage in the "We build luxury section"
            parentContainer: ".section-intro",
            targets: "header.section__head",
            animations: [
                {
                    breakpoint : "",
                    stagger: 0,
                    delayFn: "",
                    settings : '{ "animation":"fadeIn.fromBottom", "duration":"1", "start":"top 80%", "trigger":"$this", "target":".line", "stagger":".1", "splittext":"{ type:`lines`,target:`h2`, wrapLines:true, revert:true }", "markers": "false" }',
                }
            ]
        },
        // This is another single target, split text example.
        // This will split the text into words. (type: `words`) and the animation target will be `.word`
        { // NOTE: This example is on the about page in the "Build the best,"
            parentContainer: "section.section-columns",
            targets: "header.section__head",
            animations: [
                {
                    breakpoint : "",
                    stagger: 0,
                    delayFn: "",
                    settings : '{ "animation":"fadeIn.fromLeft", "duration":"1", "start":"top 80%", "trigger":"$this", "target":".word", "stagger":".1", "splittext":"{ type:`words`,target:`h2`, wrapWords:true, revert:true }", "markers": "false" }',
                }
            ]
        },
        // This is an example of multiple targets that go from 2 columns to 1 column @tablet breakpoint
        // First breakpoint will be empty because that will be the default 2 columns
        // Use the delayFn to setup the stagger delay by changing the number at the end. Ex: "return parseFloat(this.stagger * (arguments[0] % 2))" => 2 columns
        // Must use "delay": "{{staggerAmount}}", this will be the delay to stagger the animation by columns set by the delayFn
        // NOTE: The target for the scroll trigger is set to $this meaning the ".projects__item".
        // However the animation target is set to ".project" meaning the element that is fading up is .project and not the trigger element itself (.projects__item)
        // We do this because if the scroll trigger is also the element being animated it will throw off the trigger point
        // (in this case the element is fading up so when gsap sets up the element to be animated it's going to move it down so that it can fade up, which will move the trigger point down as well)
        { // NOTE: This example is on the /projects/ page
            parentContainer: "section.section-projects",
            targets: ".projects__item",
            animations: [
                {
                    breakpoint : "",
                    stagger: .5,
                    delayFn: "return parseFloat(this.stagger * (arguments[0] % 2))",
                    settings : '{ "animation":"fadeIn.fromBottom", "target": ".project", "trigger": "$this", "duration":"1.5","start":"top 95%", "delay": "{{staggerAmount}}", "clearProps": "true", "toggleClass": "st-active", "markers": "false" }',
                },
                {
                    breakpoint : "tablet",
                    stagger: 0,
                    delayFn: "",
                    settings : '{ "animation":"fadeIn.fromBottom", "target": ".project", "trigger": "$this", "duration":"1.5","start":"top 95%", "delay": "{{staggerAmount}}", "clearProps": "true", "toggleClass": "st-active", "markers": "false" }',
                }
            ]
        },
        // CARNATION EXAMPLE: Just another example with more breakpoints
        // This is an example of multiple targets that go from 4 columns to 2 columns @max-width: 1400px and then to 1 columns @phone breakpoint
        // First breakpoint will be empty because that will be the default 4 columns
        // Use the delayFn to setup the stagger delay by changing the number at the end. Ex: return parseFloat(this.stagger * (arguments[0] % 4)) => 4 columns
        // Must use "delay": "{{staggerAmount}}", this will be the delay to stagger the animation by columns set by the delayFn
        // NOTE: The target for the scroll trigger is set to $this meaning the ".product-card".
        // However the animation target is set to "> .inner-wrap" meaning the element that is fading up is the .inner-wrap and not the trigger element itself (.product-card)
        // We do this because if the scroll trigger is also the element being animated it will throw off the trigger point
        // (in this case the element is fading up so when gsap sets up the element to be animated it's going to move it down so that it can fade up, which will move the trigger point down as well)
        { // NOTE: This example is on the /washes/ page
            parentContainer: ".wash-plans-sec.section-small",
            targets: ".product-card",
            animations: [
                {
                    breakpoint : "",
                    stagger: .5,
                    delayFn: "return parseFloat(this.stagger * (arguments[0] % 4))",
                    settings : '{ "animation":"fadeIn.fromBottom", "target": "> .inner-wrap", "trigger": "$this", "duration":"1.5","start":"top 95%", "delay": "{{staggerAmount}}", "clearProps": "true", "toggleClass": "st-active", "markers": "false" }',
                },
                {
                    breakpoint : "(max-width: 1400px)",
                    stagger: .5,
                    delayFn: "return parseFloat(this.stagger * (arguments[0] % 2))",
                    settings : '{ "animation":"fadeIn.fromBottom", "target": "> .inner-wrap", "trigger": "$this", "duration":"1.5","start":"top 95%", "delay": "{{staggerAmount}}", "clearProps": "true", "toggleClass": "st-active", "markers": "false" }',
                },
                {
                    breakpoint : "phone",
                    stagger: 0,
                    delayFn: "",
                    settings : '{ "animation":"fadeIn.fromBottom", "target": "> .inner-wrap", "trigger": "$this", "duration":"1.5","start":"top 95%", "delay": "{{staggerAmount}}", "clearProps": "true", "toggleClass": "st-active", "markers": "false" }',
                }
            ]
        },
    ];

    items.forEach(init);


    function init(item) {
        const $sec = $main.find(item.parentContainer);
        if (!$sec.length) return;
        const $target = $sec.find(item.targets);
        if (!$target.length) { log("no targets found", $sec); return; }
        let animationObj;

        setAnimationSettings(item.animations);
        if (animationObj != false) $target.each(setup);


        function setup(i, target) {
            const delayFN = (typeof animationObj.delayFn != "undefined") ? animationObj.delayFn : "return parseFloat(this.stagger * (arguments[0] + 1))";
            const staggerAmount = Function(delayFN).apply(animationObj, [i]);//log("STAG",staggerAmount);
            const animationString = animationObj.settings.replace("{{staggerAmount}}", staggerAmount);//log("animation",animationString);
            
            $(target).attr("data-scrolltrigger", animationString).removeClass("st-hidden");
        }
        function setAnimationSettings(animations) {
            let animation = false;
            item.animations.forEach(_animation => {
                if (_animation.breakpoint === "" || mq(_animation.breakpoint)) {
                    animation = _animation;
                }
            });
            if (!animation) { log("no animation found", animations); }
            animationObj = animation;
        }
    }
}