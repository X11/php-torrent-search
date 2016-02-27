<?php
namespace TorrentSearch\Provider;

use Buzz\Browser;

abstract class AbstractProvider 
{

    abstract public function parseUrl($query, $page);

    abstract public function transform($content);

    /**
     * @var Browser
     */
    protected $browser;

    public function __construct()
    { 
        $this->browser = new Browser();
    }

    /**
     * Search
     *
     * @return Array
     */
    public function search($query, $page=null)
    {
        $url = $this->parseUrl($query, $page);

        try {
            $res = $this->browser->get($url);
        } catch (\Exception $e) {
            throw $e;
        }

        if ($res->getStatusCode() != 200) {
            return null;
        } else {
            return $this->transform($res->getContent());
        }
    }
         
}
