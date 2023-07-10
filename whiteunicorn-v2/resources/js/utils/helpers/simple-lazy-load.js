//-- Simple custom Lazy Load --//
export default function lazyLoad($el) {
    var $this = $(this) || $el,
        src = ($this[0].getAttribute("data-src")) ? $this[0].dataset.src : false,
        srcset = ($this[0].getAttribute("data-srcset")) ? $this[0].dataset.srcset : false;

    if (!src) { return; }
    if (srcset != false) { $this.attr("srcset",srcset); }
    $this.attr("src",src).removeAttr("data-src").removeAttr("data-srcset").addClass("js-loaded");
}