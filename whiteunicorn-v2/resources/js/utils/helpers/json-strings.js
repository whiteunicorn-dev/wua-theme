//-- JSON String --//
export default function isJson(str) {
    try { JSON.parse(str); }
    catch(err) { return false; }
    return true;
}