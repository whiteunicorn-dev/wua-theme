//-- Get oEmbed Video Type and ID --//
export function parseVideo(url) {
    //https://gist.github.com/yangshun/9892961
    url.match(/(https?:\/\/|\/\/|)(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

    if (RegExp.$3.indexOf('youtu') > -1) {
        var type = 'youtube';
    } else if (RegExp.$3.indexOf('vimeo') > -1) {
        var type = 'vimeo';
    }

    return {
        type: type,
        id: RegExp.$6
    };
}
//-- Get iFrame HTML for Vimeo or YouTube --//
export function getEmbedHTML(url, config) {
    // Returns an iframe of the video with the specified URL.
    var videoObj = parseVideo(url),
        w = config.width || "100%",
        h = config.height || "100%",
        src = (videoObj.type == 'youtube') ? '//www.youtube.com/embed/' + videoObj.id : '//player.vimeo.com/video/' + videoObj.id,
        classname = config.classname || 'oembed-iframe',
        autoplay = (config.autoplay == true) ? 1 : 0 || 0,
        loop = (config.loop == true) ? 1 : 0 || 0,
        parameters = `autoplay=${autoplay}&loop=${loop}`,
        attributes = '',
        iframe = '';

    //Youtube
    if (videoObj.type == 'youtube') {
        if (autoplay == 1) {
            parameters += `&mute=1&playlist=${videoObj.id}`;//for iframe need to use playlist of the same video for it to loop https://developers.google.com/youtube/player_parameters#autoplay
            attributes = `allow="accelerometer; autoplay;" autoplay="${autoplay}"`;
        }
    }
    //Vimeo
    else {
        if (autoplay == 1) {
            parameters += `&muted=1`;
            attributes = `allow="autoplay; fullscreen"`;
        }
    }

    iframe = `<iframe width="${w}" height="${h}" class="${classname}" frameborder="0" src="${src}?${parameters}" ${attributes}></iframe>`;

    return iframe;
}
//-- Get oEmbed video thumbnail --//
export function getVideoThumbnail (url, cb) {
    // Obtains the video's thumbnail and passed it back to a callback function.
    var videoObj = parseVideo(url);
    if (videoObj.type == 'youtube') {
        cb('//img.youtube.com/vi/' + videoObj.id + '/maxresdefault.jpg');
    } else if (videoObj.type == 'vimeo') {
        // Requires jQuery
        $.get('http://vimeo.com/api/v2/video/' + videoObj.id + '.json', function(data) {
            cb(data[0].thumbnail_large);
        });
    }
}
//-- Parse Vimeo Url to get video ID --//
export function getVimeoID(url) {
    // Look for a string with 'vimeo', then whatever, then a
    // forward slash and a group of digits.
    var match = /vimeo.*\/(\d+)/i.exec( url );

    // If the match isn't null (i.e. it matched)
    if (match) {
        // The grouped/matched digits from the regex
        return match[1];
    }
}