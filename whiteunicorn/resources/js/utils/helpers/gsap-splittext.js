//-- Text Wrap Helpers --//
export function wrapLines($this) {
    var $lines = $this.find(".line.splitText-item");
    $lines.each(wrap);
    function wrap() {
        $(this).wrap('<div class="line-wrap"></div>');
    }
}
export function wrapWords($this) {
    var $words = $this.find(".word.splitText-item");
    $words.each(wrap);
    function wrap() {
        $(this).wrap('<div class="word-wrap"></div>');
    }
}
export function wrapChars($this) {
    var $chars = $this.find(".char.splitText-item");
    $chars.each(wrap);
    function wrap() {
        $(this).wrap('<div class="char-wrap"></div>');
    }
}