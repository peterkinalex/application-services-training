<?php

namespace Chinook\DigitalMedia\DomainModel\Album;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="Album", uniqueConstraints={@ORM\UniqueConstraint(name="IPK_Album", columns={"AlbumId"})}, indexes={@ORM\Index(name="IFK_AlbumArtistId", columns={"ArtistId"})})
 * @ORM\Entity
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="AlbumId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=160, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="ArtistId", type="integer", nullable=false)
     */
    private $artistId;

    /**
     * Class constructor
     *
     * @param $title
     * @param $artistId
     */
    public function __construct($title, $artistId)
    {
        $this->title = $title;
        $this->artistId = $artistId;
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function artistId()
    {
        return $this->artistId;
    }

    /**
     * @param int $artistId
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;
    }
}
