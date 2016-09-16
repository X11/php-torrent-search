<?php

namespace TorrentSearch\Provider;

use Symfony\Component\DomCrawler\Crawler;
use TorrentSearch\Model\Torrent;

class ExtratorrentProvider extends AbstractProvider
{
    /**
     * @param string
     * @param int
     *
     * @return string
     */
    public function parseUrl($query, $page = 1)
    {
        $query = str_replace(['\'', ':'], '', $query);

        return sprintf('http://extratorrent.cc/search/?search=%s&page=%s&new=1', urlencode($query), $page);
    }

    /**
     * @param string
     *
     * @return Torrent[]
     */
    public function transform($content)
    {
        $crawler = new Crawler($content);

        return $crawler->filter('table.tl > tr')->each(function ($node) {
            $torrent = new Torrent();

            $data = $node->filter('td');
            $link = $node->filter('a[href^="/torrent/"]')->attr('href');

            $torrent->setName($data->eq(2)->text())
                    ->setSize($data->eq(4)->text())
                    ->setSeeds($data->eq(5)->text())
                    ->setPeers($data->eq(6)->text())
                    ->setMagnet($this->getMagnet($link));

            return $torrent;
        });
    }

    /**
     * @param string
     *
     * @return string
     */
    private function getMagnet($link)
    {
        $content = $this->fetch('http://extratorrent.cc'.$link);
        $crawler = new Crawler($content);

        return $crawler->filter('[title="Magnet link"]')->attr('href');
    }
}
