function omdb(topic, link) {

    let url = 'https://www.omdbapi.com/';
    let params = "?t=" + topic.split(' ').join('+');
    let key = '&apikey=3a9b65f7';

    let omdb = url + params + key;


    $(document).ready(function () {
        $.getJSON(omdb, function (results) {
            $('.omdb-content').append("<a href=\'" + link + "\' target='_blank' property='thumbnailUrl'><img property='image' src='" + results.Poster + "' class='omdb-img'></a>")
        });
    });
}


$.getJSON("json/self-created.json", function (data) {
    $.each(data.movies, function (key, val) {
        omdb(val.title, val.link);
    });
});