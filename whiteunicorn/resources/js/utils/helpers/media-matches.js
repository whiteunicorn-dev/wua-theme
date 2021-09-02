//-- Media Matches Shortcut --//
export default function mq(mediaQuery) {
    switch (mediaQuery) {
        case "phone": mediaQuery = "(max-width: 767px), screen and (max-width: 812px) and (orientation: landscape)"; break;
        case "not phone": mediaQuery = "(min-width: 768px)"; break;
        case "tablet": mediaQuery = "(max-width: 1023px)"; break;
        case "desktop": mediaQuery = "(min-width: 1024px)"; break;
        case "portrait": mediaQuery = "(orientation: portrait)"; break;
        case "landscape": mediaQuery = "(orientation: landscape)"; break;
        default: mediaQuery = mediaQuery;
    }
    mediaQuery = (!mediaQuery.includes("(") && !mediaQuery.includes(")")) ? `(${mediaQuery})` : mediaQuery;//if forget to put ()
    return window.matchMedia(mediaQuery).matches;
}