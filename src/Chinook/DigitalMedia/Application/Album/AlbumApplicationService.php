<?php

namespace Chinook\DigitalMedia\Application\Album;

use Chinook\DigitalMedia\DomainModel\Album\Album;
use Chinook\DigitalMedia\DomainModel\Album\AlbumRepository;

class AlbumApplicationService
{
    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function createAlbum($title, $artistId)
    {
        $this->albumRepository->add(
            new Album($title, $artistId)
        );
    }
}