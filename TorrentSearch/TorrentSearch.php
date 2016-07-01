<?php

namespace TorrentSearch;

use TorrentSearch\Provider\KatProvider;

class TorrentSearch
{
    protected $providers;

    /**
     * @param mixed 
     */
    public function __construct()
    {
        $this->providers = [
            new KatProvider(),
        ];
    }

    /**
     * @param string
     * @param int
     */
    public function search($query, $page = null)
    {
        $results = array();

        array_walk($this->providers, function ($provider) use ($query, $page, &$results) {
            $results = array_merge($results, $provider->search($query, $page));
        });

        return $this->filter($results);
    }

    /**
     * Filter torrents.
     */
    protected function filter($torrents)
    {
        return array_unique($torrents, SORT_REGULAR);
    }
}
