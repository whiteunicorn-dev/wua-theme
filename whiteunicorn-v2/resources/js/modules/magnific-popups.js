import 'magnific-popup';
import { $doc } from "../utils/globals";

function mfpInit() {
    $doc.on("click", ".js-mfp-video", videoIframeLinks);
    $doc.on("click", ".js-mfp-oembed", videoIframeLinks);
    $doc.on("click", ".js-mfp-image", imageLinks);
    $doc.on("click", ".js-mfp-gallery", galleryLinks);
    $doc.on("click", ".js-mfp-ajax", ajaxLinks);
    

    function imageLinks(e) {
        e.preventDefault();
        $.magnificPopup.open({
            items: {
              src: $(this).attr("href"),
            },
            type: 'image',
            image: {
                markup: '<div class="mfp-figure">'+
                          '<div class="mfp-close"></div>'+
                          '<div class="mfp-img"></div>'+
                          '<div class="mfp-bottom-bar">'+
                            '<div class="mfp-title"></div>'+
                            '<div class="mfp-counter"></div>'+
                          '</div>'+
                        '</div>', // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
                cursor: 'mfp-zoom-out-cur', // Class that adds zoom cursor, will be added to body. Set to null to disable zoom out cursor.
                titleSrc: 'title', // Attribute of the target element that contains caption for the slide.
                // Or the function that should return the title. For example:
                // titleSrc: function(item) {
                //   return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                // }
              
                verticalFit: true, // Fits image in area vertically
              
                tError: '<a href="%url%">The image</a> could not be loaded.' // Error message
            }
        }, 0);
    }
    function videoIframeLinks(e) {
        e.preventDefault();
        const $this = $(this);
        $.magnificPopup.open({
            items: {
              src: $this.attr("href") || $this.data("href"),
            },
            type: 'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                          '<div class="mfp-close"></div>'+
                          '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                        '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                
                        id: 'v=', // String that splits URL in a two parts, second part should be %id%
                        // Or null - full URL will be returned
                        // Or a function that should return %id%, for example:
                        // id: function(url) { return 'parsed id'; }
                
                        src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    }
                },
                srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            }
        }, 0);
    }
    function ajaxLinks(e) {
        e.preventDefault();
        $.magnificPopup.open({
            items: {
              src: $(this).attr("href"),
            },
            type: 'ajax'
        }, 0);
    }
    function galleryLinks(e) {
        e.preventDefault();
        const $target = $(this);
        const $sec = $target.closest(".js-gallery-section");
        const $items = $sec.find(".js-mfp-gallery");
        const imageIndex = ( $target.closest(".js-gallery-item").length ) ? $target.closest(".js-gallery-item").index() : $target.index();

        $.magnificPopup.open({
            items: getItems(),
            type: 'image',
            gallery: {
                enabled: true, // set to true to enable gallery
                preload: [0,2], // read about this option in next Lazy-loading section
                navigateByImgClick: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button
                tPrev: 'Previous (Left arrow key)', // title for left button
                tNext: 'Next (Right arrow key)', // title for right button
                tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
            }
        }, imageIndex);

        function getItems() {
            const items = [];
            $items.each((i, el) => {
                items.push({ src: $(el).attr("href") });
            });//console.log("ITEMS", items);
            return items;
        }
    }
}

export default mfpInit;