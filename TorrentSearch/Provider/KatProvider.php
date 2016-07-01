<?php

namespace TorrentSearch\Provider;

use Symfony\Component\DomCrawler\Crawler;
use TorrentSearch\Model\Torrent;

class KatProvider extends AbstractProvider
{
    /**
     * @param string 
     * @param int
     */
    public function parseUrl($query, $page = 1)
    {
        $query = str_replace(['\'', ':'], '', $query);

        return sprintf('https://kat.cr/usearch/%s/%s/?field=seeders&sorder=desc', $query, $page);
    }

    /**
     * @param string
     *
     * @return Torrent[]
     */
    public function transform($content)
    {
        $crawler = new Crawler($content);

        return $crawler->filter('tr[id^="torrent_"]')->each(function ($node) {
            return (new Torrent())
                ->setName($node->filter('a.cellMainLink')->text())
                ->setMagnet($node->filter('a[href^="magnet:?"]')->attr('href'))
                ->setSize($node->filter('td.nobr')->text())
                ->setSeeds($node->filter('td.green')->text())
                ->setPeers($node->filter('td.red')->text());
        });
    }
}
