//import log from "../utils/helpers/console-log";

export default function slickHeroSliders() {
    var $slider = $(".page-header-section").find(".slick-slider");
    if (!$slider.length) { return; }
    
    $slider.slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: pI($slider.attr("data-autoplay-speed")),
        speed: 500,
        fade: true,
        cssEase: 'linear',
        lazyLoad: 'ondemand',
        lazyLoadSrcAttr: 'data-lazy',
        lazyLoadSrcsetAttr: 'data-srcset',
    });
}