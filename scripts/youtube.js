function youtube(topic, qty) {
    let url = 'https://www.googleapis.com/youtube/v3/search?';
    var params = 'part=snippet&maxResults=' + qty + '&q='
    var key = '&key=AIzaSyDHT6Y7z95WTz-8j6CSFi6YtryOiEoORgs';

    var youtube_request = url + params + topic + key;

    $(document).ready(function () {
        $.getJSON(youtube_request, function (results) {
            $.each(results.items, function (idx, item) {
                $('ul.youtube-content').append('<li vocab="https://schema.org/" typeof="VideoObject"><iframe id="y" class="youtube-video-items" src="https://www.youtube.com/embed/' +
                    results.items[idx].id.videoId +
                    '?controls=0&showinfo=1" frameborder="1" allowfullscreen></iframe> </li>');
            });
        });
    });
}


youtube('battle royale games', 18);