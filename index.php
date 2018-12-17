<?php

/* ==========================================================================
0.1 - Twitter
========================================================================== */

/**
 * Twitter API SEARCH
 * Selim Hallaç
 * selimhallac@gmail.com
 *
 * Modified from tutorial https://www.youtube.com/watch?v=iPnGB7a7dO0
 */

include 'scripts/Twitter/twitter.php';

$consumer_key = "wfLFupIUY1csmMlfuMyFV69CA";
$consumer_secret = "DpuE6zBi1tZ5sRtZJrz9eMQw31suNyr3lb8laCTGC7CAkn8pPR";
$access_token = "1044851521886859264-E01Gb5m3SGbJeqUb6QLF3xy1b4294D";
$access_token_secret = "ugq87VSaynO7chBQxaIRMjUekpgTVcNldtvs8l97GKi06";

$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

/* ==========================================================================
0.2 - Twitch
========================================================================== */

include 'scripts/Twitch/twitch.php';

$twitch = new Twitch();

// multiple channels
$twitchFortniteChannels = $twitch->getAllLiveBroadcast('Fortnite');
$twitchPUBGChannels = $twitch->getAllLiveBroadcast('PLAYERUNKNOWN\'S BATTLEGROUNDS');
$twitchHuntShowdownChannels = $twitch->getAllLiveBroadcast('Hunt: Showdown');
$twitchH1Z1Channels = $twitch->getAllLiveBroadcast('H1Z1');


// combined mutilple channels
$allChannels = array();
$allChannels[] = $twitchFortniteChannels;
$allChannels[] = $twitchPUBGChannels;
$allChannels[] = $twitchHuntShowdownChannels;
$allChannels[] = $twitchH1Z1Channels;

/* ==========================================================================
0.2 - Webhose.io
========================================================================== */

require_once('scripts/Webhose/webhose.php');

// API Key from: https://webhose.io/dashboard
Webhose::config("45a76ea4-b8bc-4e31-9e36-0efd5952ee0a");

//Helper method to print result:

function print_filterwebdata_titles($api_response)
{
    if ($api_response == null) {
        echo "<p>Response is null, no action taken.</p>";
        return;
    }
    if (isset($api_response->posts))
        foreach (array_slice($api_response->posts, 0, 9) as $post) {
            if ($post->thread->main_image && $post->thread->title) {
                echo "<div class='webhose-items'>";
                echo "<a href='" . $post->thread->url . "' target='_blank'>";
                echo "<img src='" . $post->thread->main_image . "' alt='webhose image' class='webhose-img'>";
                echo "</a>";
                echo "<div class='webhose-meta'>";
                echo "<a href='" . $post->thread->url . "' target='_blank'>" . "<strong>" . $post->thread->title . "</strong>" . "</a> <br>";
                echo "<small>" . "Published " . substr($post->published, 0, 10) . "</small>";
                echo "</div>";
                echo "</div>";
            }
        }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php $title = 'Published News' ?>
    <?php include '_partials/header.php'; ?>
</head>
<body>

<?php include '_partials/nav.php'; ?>

<!-- /* ==========================================================================
1.0 - First Section
========================================================================== */ -->

<section class="first-section">
    <div class="content-wrapper">
        <div class="media-content">
            <!-- Tab links -->
            <div class="tab">
                <button id="nytimes-tab" class="tablinks" onclick="openMedia(event, 'NYTimes')"><i
                            class="fas fa-book-open"></i> The New
                    York Times Articles
                </button>
                <button id="youtube-tab" class="tablinks" onclick="openMedia(event, 'Youtube')"><i
                            class="fab fa-youtube"></i> Youtube Videos
                </button>
                <button id="twitch-tab" class="tablinks" onclick="openMedia(event, 'Twitch')"><i
                            class="fab fa-twitch"></i> Twitch Streams
                </button>
            </div>

            <!-- Tab content -->
            <!-- New York Times -->
            <div id="NYTimes" class="tabcontent">
                <!--The retrieved content will be appended here -->
                <div class="nyt"></div>
            </div>

            <!-- Tab content -->
            <!-- YouTube -->
            <div id="Youtube" class="tabcontent">
                <ul class="youtube-content"></ul>
            </div>

            <!-- Tab content -->
            <!-- Twitch -->
            <div id="Twitch" class="tabcontent">
                <div class="twitch">
                    <?php

                    foreach ($allChannels as $key => $channels) {
                        foreach ($channels['streams'] as $channel) {
                            //echo "<pre>" . print_r($channel) . "</pre>";
                            echo '<div class="twitch-items">';

                            echo '<div class="twitch-img-container">';
                            echo '<a href="' . $channel['url'] . '" target="_blank">';
                            echo '<img src="' . $channel['preview'] . '" alt="preview" class="twitch-img">';
                            echo '</a>';
                            echo '</div>';

                            echo '<div class="twitch-meta-container">';
                            echo '<div class="twitch-user-logo">';
                            echo '<a href="' . $channel['url'] . '" target="_blank">';
                            echo '<img src="' . $channel['logo'] . '" alt="logo">';
                            echo '</a>';
                            echo '</div>';

                            echo '<div class="twitch-meta">';
                            echo '<a href="' . $channel['url'] . '" target="_blank">';
                            echo '<strong>' . $channel['name'] . '</strong>' . '<br>';
                            echo '</a>';
                            echo $channel['title'] . '<br>';
                            echo '<small>' . 'Viewers: ' . $channel['viewers'] . '</small>';
                            echo '</div>';

                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /* ==========================================================================
2.0 - Second Section
========================================================================== */ -->

<section class="second-section">
    <div class="content-wrapper">
        <div class="sidebar-container">
            <div class="twitter-container">
                <h2>What are people saying about Battle Royale Games?</h2>

                <table class="twitter-table">
                    <?php
                    $topic = "battle royale";

                    $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=' . $topic . '&result_type=recent&count=6');

                    foreach ($tweets->statuses as $key => $tweet) {
                        if ($tweet->text != '') {
                            ?>
                            <tr class="twitter-row" vocab="http://schema.org/" typeof="SocialMediaPosting">
                                <td class="twitter-col-img">
                                    <img src="<?= $tweet->user->profile_image_url; ?>" alt="profile picture"
                                         property="image"
                                         class="twitter-img"/>
                                </td>
                                <td class="table-col">
                                    <meta property="author" content="<?= $tweet->user->screen_name; ?>">
                                    <strong><?= $tweet->user->screen_name; ?></strong>
                                    <p><?= $tweet->text; ?></p>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>

            <div class="webhose-content">
                <h2>The Latest News</h2>

                <?php
                //Perform a "filterWebContent" query
                $params = array(
                    "q" => "battle royale games language:english",
                    "sort" => "relevancy"
                );
                $result = Webhose::query("filterWebContent", $params);
                print_filterwebdata_titles($result);
                ?>
            </div>

            <div class="wikidata-container">
                <h2 class="wikidata-header">The Most Popular Battle Royale Games</h2>
                <ul class="wiki-query-results"></ul>
            </div>

            <div class="dbpedia-container">

            </div>
        </div>
        <div class="info-container">
            <h1><strong> Battle Royale Game</strong></h1>
            <div class="wiki-info-content"></div>
        </div>
    </div>
</section>

<!-- /* ==========================================================================
3.0 - Third Section
========================================================================== */ -->

<section class="third-section">
    <div class="content-wrapper">
        <div class="omdb-container">
            <h1 style="text-align: center;">You may also like</h1>
            <h2>Battle Royale Movies</h2>
            <div class="omdb-content" vocab="http://schema.org/" typeof="Movie"></div>
        </div>
        <div class="wiki-container">
            <h2>Battle Royale Games</h2>
            <div class="wiki"></div>
        </div>
        <div class="games-container">
            <h2>Maybe you'll like these other multiplayer games</h2>
            <div class="dbpedia-query-results"></div>
        </div>
    </div>
</section>

<!-- /* ==========================================================================
3.0 - Scripts
========================================================================== */ -->

<!-- JavaScripts -->
<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="assets/js/plugins.js"></script>

<!-- Functions -->
<script src="assets/js/main.js"></script>
<script src="scripts/DBpedia/dbpedia.js"></script>
<script src="scripts/wikidata.js"></script>
<script src="scripts/wiki.js"></script>
<script src="scripts/youtube.js"></script>
<script src="scripts/nytimes.js"></script>
<script src="scripts/omdb.js"></script>
<script src="json/self-created.json"></script>

<?php include '_partials/footer.php' ?>
</body>
</html>
