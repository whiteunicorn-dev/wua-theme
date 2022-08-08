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