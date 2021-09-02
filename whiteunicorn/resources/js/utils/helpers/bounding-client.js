import { $win, $doc } from "../globals";

//-- GetBoundingClientRect Shortcut --//
export function getBound(el) {//takes dom obj or jquery obj
    var node = (typeof el === "string") ? document.querySelector(el) : (el instanceof jQuery) ? el[0] : el;
    return node.getBoundingClientRect();
}

//-- Check if el in viewport --//
export function isInViewport(el) {
    var bounding = el.getBoundingClientRect(),//console.log("el",el);console.log("bounding",bounding);
        winHeight = $win.height(),
        isVisible = (
        //Y Axis
        (
            (bounding.top >= 0 && bounding.top <= winHeight)
            ||
            (bounding.bottom >= 0 && bounding.bottom <= winHeight)
        )
    );//console.log("isVisible",isVisible);
    return isVisible;
}

//-- Get scroll position as percentage (how far scrolled down page) --//
export function getScrolledPercent(round = false) {
    var winHeight = $win.height(),
        docHeight = $doc.height(),
        scrollY = $win.scrollTop(),
        scrollableLength = docHeight - winHeight,
        scrollFraction = scrollableLength / 100,
        scrolledAmount = scrollY / scrollFraction;//cl(`scrolled percent: ${scrolledAmount}`);
    return (round) ? Math.round(scrolledAmount) : scrolledAmount;
}