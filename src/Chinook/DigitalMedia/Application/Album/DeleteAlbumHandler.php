<?php

namespace Chinook\DigitalMedia\Application\Album;

use Chinook\DigitalMedia\DomainModel\Album\AlbumRepository;

class DeleteAlbumHandler
{
    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    /**
     * DeleteAlbumHandler constructor.
     *
     * @param AlbumRepository $albumRepository
     */
    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function handle(DeleteAlbumCommand $command)
    {
        $album = $this->albumRepository->ofId($command->getAlbumId());

        $this->albumRepository->remove($album);
    }
}