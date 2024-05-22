import gsap from "gsap";

/**
 * Number count-up
 * EX: gsap.effects.counter(el, { end: end, increment: 0.1, parseFloat: true, toFixed: 1, duration: 2 });
 */

gsap.registerEffect({
    name:"counter",
    extendTimeline:true,
    defaults:{
      end:0,
      duration:0.5,
      ease:"power1",
      increment:1,
      parseFloat: false, // set to true to format number with decimal
      toFixed: 1, // set decimal point for parse float
    },
    effect: (targets, config) => {
        let tl = gsap.timeline();
        let num = targets[0].innerText.replace(/\,/g,'');
        targets[0].innerText = num;
        
        tl.to(targets, {
            duration:config.duration, 
            innerText:config.end, 
            //snap:{innerText:config.increment},
            modifiers:{
                innerText:function(innerText){
                    const nextIncrement = gsap.utils.snap(config.increment, innerText);
                    const nextNum = (config.parseFloat) ? parseFloat(nextIncrement).toFixed(config.toFixed) : nextIncrement;
                    return nextNum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            ease:config.ease
        }, 0);
        return tl;
    }
});

/* Example
// stat item HTML:
<div class="stat-item">
    <div class="stat">
        <span class="js-stat" data-statnumber="1400">0</span>+
    </div>
</div>
// PHP for above code
<?php
$stat['stat'] = "1440+"; //example - also works for "$100.00" || "83%"
if ( $stat['stat'] ) :
$statNumber = get_string_between( $stat['stat'], "[", "]" );
$startNumber = ( str_contains( $stat['stat'], "." ) ) ? "0.0" : "0";
echo str_replace( "[", "<span class='js-stat' data-statnumber='$statNumber'>", str_replace( "]","</span>", str_replace( $statNumber, $startNumber, $stat['stat'] ) ) );
endif;
?>

function statCounter() {
    const $stats = $(".js-stat");
    if (!$stats.length) return;
    registerEffect(); // Run function above
    setTimeout(() => { $stats.each(addCounter); }, 1000);

    function addCounter(i, stat) {
        const $stat = $(stat);
        const $parent = $stat.closest(".stat-item");
        const statNumber = parseFloat($stat.attr("data-statnumber"));

        ScrollTrigger.create({
            trigger: $parent.get(0),
            start: "top center",
            once: true,
            //markers: true,
            onEnter: () => {
                gsap.effects.counter(stat, {
                    end: statNumber,
                    increment: 0.1,
                    parseFloat: ($stat.attr("data-statnumber").includes(".")),
                    toFixed: 1,
                    //duration: 2,
                }, 2);
            },
        });
    }
}
*/