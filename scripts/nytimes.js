function nytimes($topic, $startDate, $endDate) {
    // Built by LucyBot. www.lucybot.com
    var url = "https://api.nytimes.com/svc/search/v2/articlesearch.json";
    url += '?' + $.param({
        'api-key': "45a5af9e7b524bd7bb89c98ef92b92a4",
        'q': $topic,
        'begin_date': $startDate,
        'end_date': $endDate,
        'sort': "relevance"
    });
    $.ajax({
        url: url,
        method: 'GET',
    }).done(function (result) {
        // console.log(result);
        var article = result.response.docs;

        for (i = 0; i < article.length - 2; i++) {
            //checking if the article has an image
            if (article[i].multimedia.length < 3) {
                //no image display empty <div>
                var image = "<div></div>";
            } else {
                //if there is an image place the image information inside a single variable image
                var image = "" +
                    "<a href='http://www.nytimes.com/" + article[i].multimedia[0].url + "'>" +
                    "<img src='http://www.nytimes.com/" + article[i].multimedia[0].url + "' class='nyt_thumb' alt='" + article[i].headline.main + " image " + article[i].multimedia[2].subtype + "' title='" + article[i].headline.main + " image " + article[i].multimedia[0].subtype + "' height='" + article[i].multimedia[0].height + "'  width='" + article[i].multimedia[0].width + "' >" +
                    "</a>";
            }
            //Displaying the article content, thumbnail, title, date, snippet and URL
            var pub_date_day = String(article[i].pub_date.substring(0, 10));
            pub_date_day = pub_date_day.split('-').reverse().join('-')
            $(".nyt").append("<article vocab='http://schema.org' typeof='NewsArticle' class='nyt-items'>" + image + "<a href='" + article[i].web_url + "' target='_blank' class='nyt-headline-link'><h2 class='nyt-headline' property='name'>" + article[i].headline.main + "</h2></a>" +
                "<em class='nyt-pub-date' property='datePublished'>" + "Published " + '<meta itemprop="datePublished" content="pub_date_day">' + pub_date_day + "</em><br><br></article>");
        }

    }).fail(function (err) {
        throw err;
    });
}

nytimes("Battle Royale Games fortnite pubg", 20150101, 20190101);