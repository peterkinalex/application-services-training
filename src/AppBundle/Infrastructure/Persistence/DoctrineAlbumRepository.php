<?php

namespace AppBundle\Infrastructure\Persistence;

use Chinook\DigitalMedia\DomainModel\Album\Album;
use Chinook\DigitalMedia\DomainModel\Album\AlbumRepository;
use Doctrine\ORM\EntityManager;

class DoctrineAlbumRepository implements AlbumRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * DoctrineAlbumRepository constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function add(Album $anAlbum)
    {
        $this->em->persist($anAlbum);
        $this->em->flush($anAlbum);
    }
}