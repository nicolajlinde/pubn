window.onload = function () {
    document.getElementById('nytimes-tab').click();
};

/* Tabs - Youtube and Twitch */
function openMedia(evt, mediaName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(mediaName).style.display = "block";
    evt.currentTarget.className += " active";
}

$.getJSON("json/self-created.json", function (data) {
    console.log(data);
    $.each(data.wiki, function (key, val) {
        console.log(val);
        $('.wiki-info-content').append(
            '<p>' + val.intro[1] + '</p>',
            '<p>' + val.intro[2] + '</p>',

            '<h3><strong>' + val.concept[0] + '</strong></h3>',
            '<p>' + val.concept[1] + '</p>',
            '<p>' + val.concept[2] + '</p>',
            '<p>' + val.concept[3] + '</p>',
            '<p>' + val.concept[4] + '</p>',

            '<h3><strong>' + val.history[0] + '</strong></h3>',
            '<h4><strong>' + val.history[1] + '</strong></h4>',
            '<p>' + val.history[2] + '</p>',
            '<p>' + val.history[3] + '</p>',
            '<p>' + val.history[4] + '</p>',

            '<h3><strong>' + val.impact[0] + '</strong></h3>',
            '<p>' + val.impact[1] + '</p>',
            '<p>' + val.impact[2] + '</p>',
            '<p>' + val.impact[3] + '</p>'
        )
    });
});
