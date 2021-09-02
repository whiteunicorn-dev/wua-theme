//-- Convert String with HTML Special Chars (IE: < > etc.) --//
export default function decodeHTMLSpecialChars(string) {
    return string.replace(/</g, "<").replace(/>/g, ">").replace(/"/g, '\"');
}