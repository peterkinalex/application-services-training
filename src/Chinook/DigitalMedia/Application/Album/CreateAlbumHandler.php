<?php

namespace Chinook\DigitalMedia\Application\Album;

use Chinook\DigitalMedia\DomainModel\Album\Album;
use Chinook\DigitalMedia\DomainModel\Album\AlbumRepository;

class CreateAlbumHandler
{
    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function handle(CreateAlbumCommand $command)
    {
        $this->albumRepository->add(
            new Album($command->getTitle(), $command->getArtistId())
        );
    }
}