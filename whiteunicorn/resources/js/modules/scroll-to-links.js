import { $html, $body, events } from "../utils/globals";

export default function scrollToLinks() {
    var $scrollToLinks = $('a[href^="#"], a[href^="/#"]');

    $scrollToLinks.on("click", function(e) {
        var href = $(this).attr("href").replace("/", ""),
            $section = $(href);

        if (href == "#") { e.preventDefault(); }
        if ($section.length) {
            e.preventDefault();
            events.emit("scroll_to_link_click");
            $html.add($body).animate({
                scrollTop: $section.offset().top
            }, 1000);
        }
    });
}