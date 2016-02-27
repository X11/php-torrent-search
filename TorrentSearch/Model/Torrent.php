<?php

namespace TorrentSearch\Model;

class Torrent {

    protected $name;
    protected $magnet;
    protected $size;
    protected $seeds;
    protected $peers;

    /**
     * Getter for name=""
     *
     * return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name
     *
     * @param string $name
     * @return Torrent
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getter for magnet
     *
     * return string
     */
    public function getMagnet()
    {
        return $this->magnet;
    }

    /**
     * Setter for magnet
     *
     * @param string $magnet
     * @return Torrent
     */
    public function setMagnet($magnet)
    {
        $this->magnet = $magnet;

        return $this;
    }

    /**
     * Getter for Size
     *
     * return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Setter for Size
     *
     * @param string $Size
     * @return Torrent
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Getter for Seeds
     *
     * return string
     */
    public function getSeeds()
    {
        return $this->seeds;
    }

    /**
     * Setter for Seeds
     *
     * @param string $Seeds
     * @return Torrent
     */
    public function setSeeds($seeds)
    {
        $this->seeds = (int) $seeds;

        return $this;
    }

    /**
     * Getter for Peers
     *
     * return string
     */
    public function getPeers()
    {
        return $this->peers;
    }

    /**
     * Setter for Peers
     *
     * @param string $Peers
     * @return Torrent
     */
    public function setPeers($peers)
    {
        $this->peers = (int) $peers;

        return $this;
    }

    /**
     * Get torrent seed / peer ratio
     *
     * @return void
     */
    public function getSeedPeerRatio()
    {
        return $this->seeds / $this->peers;
    }
    
}
