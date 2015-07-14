<?php

namespace Chinook\DigitalMedia\Application\Album;

use Chinook\DigitalMedia\DomainModel\Album\AlbumRepository;

class ChangeNameHandler
{
    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function handle(ChangeNameCommand $command)
    {
        $album = $this->albumRepository->ofId($command->getId());

        $album->changeTitleFor($command->getNewName());
    }
}