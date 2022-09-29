//import log from "../utils/helpers/console-log";
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'slick-carousel';

export default function slickSliders() {
    var $slider = $(".slick-slider");
    if (!$slider.length) { return; }
    const speed = $slider.attr("data-speed") || 6000;
    
    $slider.slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: parseInt(speed),
        speed: 500,
        fade: true,
        cssEase: 'linear',
        // lazyLoad: 'ondemand',
        // lazyLoadSrcAttr: 'data-lazy',
        // lazyLoadSrcsetAttr: 'data-srcset',
    });
}