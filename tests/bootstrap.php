<?php
if (!$loader = @include __DIR__.'/../vendor/autoload.php') {
    exit(1);
}

use TorrentSearch\TorrentSearch;

$ts = new TorrentSearch();

$torrents = $ts->search('arch linux');

function sortTorrent($a, $b)
{
    if ($a === $b) return 0;
    return ($a->getSeedPeerRatio() < $b->getSeedPeerRatio()) ? 1 : -1;
}

usort($torrents, 'sortTorrent');

for ($i = 0; $i < count($torrents); $i++) {
    $t = $torrents[$i];
    echo $t->getName(), "\t", $t->getSeedPeerRatio(), PHP_EOL;
}

