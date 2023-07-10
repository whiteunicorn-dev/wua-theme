//import log from "../utils/helpers/console-log";
import { $doc, $win, events } from "../utils/globals";

export default function documentEvents() {
    //-- Document Height
    $win.on("resize", updateDocHeight);
    events.on("elHeightChanged", updateDocHeight);
    function updateDocHeight() {
        var newDocHeight = $doc.height();
        if (newDocHeight != global.docHeight) {
            global.docHeight = newDocHeight;
            events.emit("docHeightChanged", global.docHeight);
        }
    }
}