//-- Initialize scrollLock.js --//
export default function initScrollLockJS() {
    /**
    * scrolllock.js
    * https://gist.github.com/barneycarroll/6550066
    */
    $.scrollLock=function(){"use strict";var $=jQuery,l=$("html"),o=!1,t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},s={},c={"overflow-y":"scroll",position:"fixed",width:"100%"};function r(){var o,t=l.attr("style"),c={};t&&(o=t.split(/;\s/),$.each(o,function(l){if(l){var o=l.split(/\s:\s/);o.length<2||(c[o[0]]=o[1])}}),$.extend(s,c))}function n(){var s={};o||(t={scrollLeft:$(window).scrollLeft(),scrollTop:$(window).scrollTop()},r(),$.extend(s,c,{left:-t.scrollLeft+"px",top:-t.scrollTop+"px"}),l.css(s),$(window).scrollLeft(0).scrollTop(0),o=!0)}function e(){o&&(l.attr("style",$("<x>").css(s).attr("style")||""),$(window).scrollLeft(t.scrollLeft).scrollTop(t.scrollTop),o=!1)}return r(),function(l){arguments.length?l?n():e():o?e():n()}}();
}