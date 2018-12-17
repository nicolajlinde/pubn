function wiki(topic) {
    var url = "https://en.wikipedia.org/w/api.php?action=parse&format=json&page=" + topic + "&redirects&prop=text&callback=?";

    $.getJSON(url, function (results_IB) {
        var rawtext = results_IB.parse.text["*"];

        rawtext = rawtext.replace(new RegExp('href="/wiki', 'g'), 'href="https://en.wikipedia.org/wiki');
        wikiHTML = rawtext.replace(new RegExp('"//upload.', 'g'), '"https://upload.');

        $wikiDOM = $("<document>" + wikiHTML + "</document>");

        $(".wiki").append($wikiDOM.find('.infobox').html());
    });
}

$.getJSON("json/self-created.json", function (data) {
    $.each(data.games, function (key, val) {
        for (var i in val.titles) {
            wiki(val.titles[i]);
        }
    });
});