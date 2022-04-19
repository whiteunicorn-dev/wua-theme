export function lastUrlSegment() {
    var lastPart = location.href.substr(location.href.lastIndexOf('/') + 1)
    //Remove url params if this is the case.
    return lastPart.substr(0,lastPart.indexOf('?') > -1 ? lastPart.indexOf('?') : lastPart.length)
}