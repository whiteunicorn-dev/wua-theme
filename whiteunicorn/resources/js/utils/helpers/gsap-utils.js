import { pI } from "./numbers";

export function getStaggerIncrementValue(targets, index, increment) {
    if (!targets.length || typeof(index) === "undefined" || typeof(increment) === "undefined") { console.log("U messed up", targets, index, increment); return; }
    const center = pI(targets.length / 2);
    return (index - center) * increment;
}