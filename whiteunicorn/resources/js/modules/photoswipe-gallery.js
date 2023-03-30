// import PhotoSwipeLightbox from 'photoswipe/dist/photoswipe-lightbox.esm.js';
// import PhotoSwipe from 'photoswipe/dist/photoswipe.esm.js';
// import PhotoSwipeLightbox from 'photoswipe/lightbox';
// import PhotoSwipe from 'photoswipe';

import loadStyle from '../utils/helpers/load-style';
import loadScript from "../utils/helpers/load-script";
import { $body } from "../utils/globals";
import log from '../utils/helpers/console-log';

function galleryLightboxPS() {
    if (!$body.hasClass("page-template-template-gallery")) return;
    const resourcesPath = `${window.location.origin}/wp-content/themes/whiteunicorn/resources/`;
    const jsPath = `${resourcesPath}/assets/js/`;
    const cssPath = `${resourcesPath}/assets/css/`;
    const jsFiles = { core: "photoswipe.umd.min.js", lightbox: "photoswipe-lightbox.umd.min.js" };
    const jsLoaded = { core: false, lightbox: false };

    loadStyle(`${cssPath}photoswipe_v5.css`, loadJS);

    
    function loadJS() {
        if (!jsLoaded.lightbox) {
            jsLoaded.lightbox = true;
            loadScript(jsPath + jsFiles.lightbox, loadJS);
        }
        else if (!jsLoaded.core) loadScript(jsPath + jsFiles.core, init);
    }
    function init() {
        const lightbox = new PhotoSwipeLightbox({
            gallery: '.grid-wrapper',
            children: 'a',
            pswpModule: PhotoSwipe
        });
        lightbox.init();
    }
}

export default galleryLightboxPS;


function galleryLightboxPS_v4() {
    const $galleries = $main.find(".js-img-gallery");
    if (!$galleries.length) return;
    const psCSS = '/wp-content/themes/whiteunicorn/resources/assets/css/photoswipe_v4.min.css';
    const psJS = '/wp-content/themes/whiteunicorn/resources/assets/js/photoswipe_v4.js';
    let $lightbox, pswpInstance;

    loadStyle(psCSS, () => {
        loadScript(psJS, () => {
            galleryInit();
        });
    });

    
    function galleryInit() {
        $(`<div class="lightbox-cnt">${getLBTemplate()}</div>`).appendTo($body);
        $lightbox = $body.find(".lightbox-cnt .pswp");
        $galleries.on("click", ".js-lb-img", openLightbox);
    }
    function openLightbox(e) {//log("img clicked", this);
        const $target = $(this);
        const $gallery = $target.closest(".js-img-gallery");log("gallery", $gallery);
        const items = getItems($gallery);log("items", items);
        const options = { index: $target.index() };

        pswpInstance = new PhotoSwipe( $lightbox[0], PhotoSwipeUI_Default, items, options);
        pswpInstance.init();
    }
    function getItems($gallery) {
        const $items = $gallery.find(".js-lb-img");
        const items = [];

        $items.each(getOptions);
        return items;

        function getOptions() {
            const $img = $(this);
            items.push({ src: $img.data("pswp-src"), w: $img.data("pswp-width"), h: $img.data("pswp-height") });
        }
    }
}
function getLBTemplate() {
    return `
    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. 
            It's a separate element, as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. 
                    PhotoSwipe keeps only 3 slides in DOM to save memory. -->
            <div class="pswp__container">
                <!-- don't modify these 3 pswp__item elements, data is added later on -->
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

            </div>

    </div>
    `;
}