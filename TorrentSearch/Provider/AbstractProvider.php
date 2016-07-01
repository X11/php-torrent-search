<?php

namespace TorrentSearch\Provider;

abstract class AbstractProvider
{
    abstract public function parseUrl($query, $page);

    abstract public function transform($content);

    /**
     * undocumented function.
     */
    public function fetch($url)
    {
        $curl = curl_init();
        $opts_array = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => '',
        );
        curl_setopt_array($curl, $opts_array);
        $resp = curl_exec($curl);
        curl_close($curl);

        if ($resp != '') {
            return $resp;
        } else {
            throw new \Exception('CURL empty string');
        }
    }

    /**
     * Search.
     *
     * @return array
     */
    public function search($query, $page = null)
    {
        $url = $this->parseUrl($query, $page);

        try {
            $res = $this->fetch($url);
        } catch (\Exception $e) {
            throw $e;
        }

        return $this->transform($res);
    }
}
