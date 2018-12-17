function makeSPARQLQuery(endpointUrl, sparqlQuery, doneCallback) {
    var settings = {
        headers: {Accept: 'application/sparql-results+json'},
        data: {query: sparqlQuery}
    };
    return $.ajax(endpointUrl, settings).then(doneCallback);
}

var endpointUrl = 'https://query.wikidata.org/sparql',
    sparqlQuery = "SELECT ?br ?brLabel ?platform ?gameEngine ?publisher ?developer ?releaseDate ?logo ?distribution ?website ?metacritic\n" +
        "\n" +
        "WHERE {\n" +
        "    ?br wdt:P136 wd:Q30607131 .\n" +
        "    ?br wdt:P31 wd:Q7889 .\n" +
        "\n" +
        "  SERVICE wikibase:label {\n" +
        "    bd:serviceParam wikibase:language \"en\" .          \n" +
        "  }\n" +
        "}";

makeSPARQLQuery(endpointUrl, sparqlQuery, function (data) {
    $.each(data.results.bindings, function (idx, item) {
        $('<li>' + '<a href="' + item['br']['value'] + '" target="_blank">' + item['brLabel']['value'] + '</a>' + '</li>').appendTo('.wiki-query-results');
    });
});