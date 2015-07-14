<?php

namespace Chinook\DigitalMedia\Application\Album;

class DeleteAlbumCommand
{
    /**
     * @var int
     */
    private $albumId;

    /**
     * @param $albumId
     */
    public function __construct($albumId)
    {
        $this->albumId = $albumId;
    }

    public function getAlbumId()
    {
        return $this->albumId;
    }
}
