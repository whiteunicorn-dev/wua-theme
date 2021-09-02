import log from "../utils/helpers/console-log";
import loadScript from "../utils/helpers/load-script";
import { $main } from "../utils/globals";

export default function vimeoModals() { //Use with Magnific Popup
    var $videoSections = $main.find(".section-video");
    if (!$videoSections.length) { return; }
      
    loadScript('https://player.vimeo.com/api/player.js', init);
  
    function init() {//cl("video vimeo init");
        $videoSections.find(".js-video-popup").on('mfpOpen', function(e) {
            playVideo();
        });
    }
    function playVideo() {log("play video");
        var $modal = $(".mfp-container"),
            $iframeVid = $modal.find(".mfp-iframe"),
            player = new Vimeo.Player($iframeVid[0]);//log("player play", player);
      
        player.play();
    }
}