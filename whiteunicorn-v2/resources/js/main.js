/*
 * Polyfills
 */
import './polyfills/object-fit';

/*
 * Modules
 */
import { $win, $doc } from "./utils/globals";
import windowEvents from "./modules/window-events";
import documentEvents from "./modules/document-events";
import bodyEvents from "./modules/body-events";
import initScrollLockJS from "./utils/helpers/scrollLock";
import navTrigger from "./modules/navigation";
import modalTrigger from "./modules/modals";
import lazyIframeOEmbed from "./modules/lazy-oembed";
import vimeoModals from "./modules/vimeo-modals";
import scrollToLinks from "./modules/scroll-to-links";
import scrollTriggerAnimation from "./modules/scroll-trigger-items";
import homePage from './modules/page--home';

/*
 * Init
 */
jQuery(document).ready(function($) {
    //Global Variables
    global.winWidth = $win.width();
    global.winHeight = $win.height();
    global.docHeight = $doc.height();
    global.scrollY = $win.scrollTop();

    //Global Functions/Events
    windowEvents();
    documentEvents();
    bodyEvents();
    initScrollLockJS();
    
    //Page Functions
    homePage();

    //Site Common Functions
    navTrigger();
    modalTrigger();
    lazyIframeOEmbed();
    vimeoModals();
    scrollToLinks();
    scrollTriggerAnimation();
});