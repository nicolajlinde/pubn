function makeSPARQLQuery(endpointUrl, sparqlQuery, doneCallback) {
    var settings = {
        headers: {Accept: 'application/sparql-results+json'},
        data: {query: sparqlQuery}
    };
    return $.ajax(endpointUrl, settings).then(doneCallback);
}


var endpointUrl = 'https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=',
    sparqlQuery = 'PREFIX dbo:<http://dbpedia.org/ontology/> ' +
        'PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#> ' +
        'SELECT * WHERE { ' +
        '?game a dbo:VideoGame . ' +
        '?game rdfs:label ?title . ' +
        '?game rdfs:comment ?description . ' +
        '?game dct:subject dbc:Cooperative_video_games . ' +
        '?game dbp:modes dbr:Multiplayer_video_game . ' +
        '?game dbo:thumbnail ?image . ' +
        'FILTER (lang(?title) = "en") . ' +
        'FILTER (lang(?description) = "en") . ' +
        '} ' +
        'LIMIT 10';

makeSPARQLQuery(endpointUrl, sparqlQuery, function (data) {
    $.each(data.results.bindings, function (idx, item) {
        console.log(item);
        $(
            '<div class="dbpedia-item">' +
            '<img src="' + item['image']['value'] + '" alt="' + item['title']['value'] + '">' +
            '<a href="' + item['game']['value'] + '" target="_blank">' +
            '<h3>' +
            item['title']['value'] +
            '</h3>' +
            '</a>' +
            '</div>'
        ).appendTo('.dbpedia-query-results');
    });
});
