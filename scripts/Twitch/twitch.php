<?php
/*
Made in association with:
Sebastian Aarslev Jakobsen
http://vidyagame.com
*/

class Twitch
{
    public function twitchBroadcast($twitchStreams)
    {

        $totalStreams = array('_total' => $twitchStreams['_total']);

        foreach ($twitchStreams['streams'] as $stream) {

            $streamsArray[] = array('name' => $stream['channel']['display_name'],
                'viewers' => $stream['viewers'],
                'logo' => $stream['channel']['logo'],
                'title' => $stream['channel']['status'],
                'url' => $stream['channel']['url'],
                'stream_embed' => 'https://player.twitch.tv/?channel=' . $stream['channel']['name'] . '',
                'preview' => $stream['preview']['large'],
                'chat_embed' => 'https://www.twitch.tv/' . $stream['channel']['name'] . '/chat');

        }


        $streams = array_merge($totalStreams, array('streams' => $streamsArray));

        if (isset($streams)) {
            return $streams;
        } else {
            return $streams = array();
        }
    }

    public function twitchTopBroadcast($twitchStreams)
    {

        $totalStreams = array('_total' => $twitchStreams['_total']);

        foreach ($twitchStreams['top'] as $stream) {

            $streamsArray[] = array('name' => $stream['game']['name'],
                'viewers' => $stream['viewers'],
                'logo' => $stream['game']['box']['small'],
                'icon' => "https://static.vgbuff.com/images/twitch-icon.png",
                'url' => 'https://www.twitch.tv/directory/game/' . $stream['game']['name']);
        }

        $streams = array_merge($totalStreams, array('streams' => $streamsArray));

        if (isset($streams)) {
            return $streams;
        } else {
            return $streams = array();
        }
    }

    public function getAllLiveBroadcast($title)
    {

        $streams = array();
        $twitchAPI = "https://api.twitch.tv/kraken/streams?game=" . str_replace(' ', '+', $title) . "&limit=3";

        $twitchClientID = '&client_id=ld5er8tyuxzglilffl52mbr0tp7ex4&client_secret=qt4lvmp50ynsul1wbxg4fh09kkhh0c';
        $twitchLiveChannels = $this->getGameLiveStreams($twitchAPI, $twitchClientID);
        if ($twitchLiveChannels['streams']) {
            $streams = array_merge($streams, $this->twitchBroadcast($twitchLiveChannels));
        }
        if (count($streams) > 0) {
            return $streams;
        } else {
            return null;
        }
    }

    public function getTopLiveBroadcast()
    {

        $streams = array();
        $twitchAPI = "https://api.twitch.tv/kraken/games/top?limit=5";

        $twitchClientID = '&client_id=ld5er8tyuxzglilffl52mbr0tp7ex4&client_secret=qt4lvmp50ynsul1wbxg4fh09kkhh0c';
        $twitchLiveChannels = $this->getGameLiveStreams($twitchAPI, $twitchClientID);
        if ($twitchLiveChannels['top']) {
            $streams = array_merge($streams, $this->twitchTopBroadcast($twitchLiveChannels));
        }

        return $streams;

    }

    public function getGameLiveStreams($twitchAPI, $twitchClientID)
    {
        return json_decode(file_get_contents($twitchAPI . $twitchClientID, false), true);

    }
}

?>