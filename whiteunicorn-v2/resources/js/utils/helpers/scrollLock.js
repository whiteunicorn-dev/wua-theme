/**
 * Initialize scrolllock.js
 *
 * Original scrollLock function
 * NOTE: Originally a jQuery plugin, used the function $.scrollLock()
 * NOTE: Needs to be initialized before you can call the function ($.scrollLock)
 */
export default function initScrollLockJS() {
    $.scrollLock=function(){"use strict";var l=$("html"),o=!1,t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},s={},r={"overflow-y":"scroll",position:"fixed",width:"100%"};function c(){var o=l.attr("style"),t=[],r={};if(o){try{t=o.split(/;\s/)}catch(l){return}$.each(t,(function(l,o){if(o){var t=o.split(/\s:\s/);t.length<2||(r[t[0]]=t[1])}})),$.extend(s,r)}}function n(){var s={};o||(t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},c(),$.extend(s,r,{left:-t.scrollLeft+"px",top:-t.scrollTop+"px"}),l.css(s),$(window).scrollLeft(0).scrollTop(0),o=!0)}function e(){o&&(l.attr("style",$("<x>").css(s).attr("style")||""),$(window).scrollLeft(t.scrollLeft).scrollTop(t.scrollTop),o=!1)}return c(),function(l){arguments.length?l?n():e():o?e():n()}};
}



/**
 * Scroll Lock 
 * TODO: Make this the default export. Need to modify anywhere using $.scrollLock() => scrollLock()
 * 
 * Keeps screen in fixed position and prevents user from scrolling
 * @params {boolean} lock/unlock | default: toggle
 * @returns function
 * @example scrollLock(true) | scrollLock(false) | scrollLock()
 * 
 * NOTE: this code was taken and modified from scrolllock.js
 * https://gist.github.com/barneycarroll/6550066
 */
const $win = $(window);
const $html = $('html');
const lockStyles = {
    'overflow-y' : 'scroll',
    'position'   : 'fixed',
    'width'      : '100%'
};
let locked = false; // State: unlocked by default
let prevScroll = { // State: scroll to revert to
    scrollLeft : $win.scrollLeft(),
    scrollTop  : $win.scrollTop()
}; 
let prevStyles = {}; // State: styles to revert to
export function scrollLock(l){function o(){var l,o=$html.attr("style"),t={};o&&(l=o.split(/;\s/),$.each(l,(function(l,o){if(o){var c=o.split(/\s:\s/);c.length<2||(t[c[0]]=c[1])}})),$.extend(prevStyles,t))}function t(){if(!locked){var l={};prevScroll={scrollLeft:$win.scrollLeft(),scrollTop:$win.scrollTop()},o(),$.extend(l,lockStyles,{left:-prevScroll.scrollLeft+"px",top:-prevScroll.scrollTop+"px"}),$html.css(l),$win.scrollLeft(0).scrollTop(0),locked=!0}}function c(){locked&&($html.attr("style",$("<x>").css(prevStyles).attr("style")||""),$win.scrollLeft(prevScroll.scrollLeft).scrollTop(prevScroll.scrollTop),locked=!1)}o(),arguments.length?l?t():c():locked?c():t()}



/* Unminified version of scrollLock() */
export function scrollLock_unMinfied(on) {
    /* Init */
    // Instantiate cache in case someone tries to unlock before locking
    saveStyles();
    if( arguments.length ) {
        if (on) lock();
        else unlock();
    }
    // Otherwise, toggle
    else {
        if(locked) unlock();
        else lock();
    }


    /* Functions */
    // Save context's inline styles in cache
    function saveStyles() {
        var styleAttr = $html.attr( 'style' ),
            styleStrs = [],
            styleHash = {};
        if(!styleAttr) return;

        styleStrs = styleAttr.split( /;\s/ );
        $.each( styleStrs, function serializeStyleProp(i, styleString){/*NOTE: Modified by WUA, serializeStyleProp(styleString) => serializeStyleProp(i, styleString)*/
            if( !styleString ) {
                return;
            }
            var keyValue = styleString.split( /\s:\s/ );
            if( keyValue.length < 2 ) {
                return;
            }
            styleHash[ keyValue[ 0 ] ] = keyValue[ 1 ];
        });
        $.extend( prevStyles, styleHash );
    }

    function lock() {
        if(locked) return; // Duplicate execution will break DOM statefulness
        var appliedLock = {};
        // Save scroll state...
        prevScroll = {
            scrollLeft : $win.scrollLeft(),
            scrollTop  : $win.scrollTop()
        };
        // ...and styles
        saveStyles();

        // Compose our applied CSS
        $.extend( appliedLock, lockStyles, {
            // And apply scroll state as styles
            'left' : - prevScroll.scrollLeft + 'px',
            'top'  : - prevScroll.scrollTop  + 'px'
        });

        // Then lock styles...
        $html.css( appliedLock );

        // ...and scroll state
        $win
        .scrollLeft( 0 )
        .scrollTop( 0 );

        locked = true;
    }

    function unlock() {
        if(!locked) return; // Duplicate execution will break DOM statefulness
        // Revert styles
        $html.attr( 'style', $( '<x>' ).css( prevStyles ).attr( 'style' ) || '' );
        
        // Revert scroll values
        $win
        .scrollLeft( prevScroll.scrollLeft )
        .scrollTop(  prevScroll.scrollTop );

        locked = false;
    }
}

/** 
 * Original scrollLock function
 * NOTE: Originally a jQuery plugin, used the function $.scrollLock()
 * NOTE: Needs to be initialized before you can call the function ($.scrollLock)

export default function initScrollLockJS() {
    $.scrollLock=function(){"use strict";var l=$("html"),o=!1,t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},s={},r={"overflow-y":"scroll",position:"fixed",width:"100%"};function c(){var o=l.attr("style"),t=[],r={};if(o){try{t=o.split(/;\s/)}catch(l){return}$.each(t,(function(l,o){if(o){var t=o.split(/\s:\s/);t.length<2||(r[t[0]]=t[1])}})),$.extend(s,r)}}function n(){var s={};o||(t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},c(),$.extend(s,r,{left:-t.scrollLeft+"px",top:-t.scrollTop+"px"}),l.css(s),$(window).scrollLeft(0).scrollTop(0),o=!0)}function e(){o&&(l.attr("style",$("<x>").css(s).attr("style")||""),$(window).scrollLeft(t.scrollLeft).scrollTop(t.scrollTop),o=!1)}return c(),function(l){arguments.length?l?n():e():o?e():n()}};
}


/** 
 * This is another way to do it but needs to be ran as an anonymous self-executing function to work correctly.
 * NOTE: Anonymous functions cannot be exported from a module unless it is the default
 * @params {boolean} lock/unlock | default: toggle
 * @returns function
 * @example scrollLock(true) | scrollLock(false) | scrollLock()

export default (function scrollLock() {
    "use strict";var l=$("html"),o=!1,t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},s={},r={"overflow-y":"scroll",position:"fixed",width:"100%"};function c(){var o=l.attr("style"),t=[],r={};if(o){try{t=o.split(/;\s/)}catch(l){return}$.each(t,(function(l,o){if(o){var t=o.split(/\s:\s/);t.length<2||(r[t[0]]=t[1])}})),$.extend(s,r)}}function n(){var s={};o||(t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},c(),$.extend(s,r,{left:-t.scrollLeft+"px",top:-t.scrollTop+"px"}),l.css(s),$(window).scrollLeft(0).scrollTop(0),o=!0)}function e(){o&&(l.attr("style",$("<x>").css(s).attr("style")||""),$(window).scrollLeft(t.scrollLeft).scrollTop(t.scrollTop),o=!1)}return c(),function(l){arguments.length?l?n():e():o?e():n()}
})();
*/