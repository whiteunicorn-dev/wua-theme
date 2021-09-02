import { $main } from "../utils/globals";
import { parseVideo } from "../utils/helpers/oembed";

export default function lazyIframeOEmbed() {
    var $oEmbedIframe = $main.find("iframe.lazy-oembed");
    if (!$oEmbedIframe.length) { return; }
    
    $oEmbedIframe.each(loadIframe);
        
    function loadIframe() {
        var $this = $(this),
            videoSrc = getSrc($this.attr("data-src"));
        
        $this
        .attr("frameborder","0")
        .attr("allowfullscreen", "")
        .attr("src", videoSrc);
    }
    function getSrc(url) {
        var embedObj = parseVideo(url);
        
        switch(embedObj.type) {
            case "vimeo":
                return `//player.vimeo.com/video/${embedObj.id}?autoplay=1&autopause=0`;
                break;
            case "youtube":
                return `//www.youtube.com/embed/${embedObj.id}?autoplay=1`;
                break;
            default:
                return url;
        }
    }
}