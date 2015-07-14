<?php

namespace Chinook\DigitalMedia\Application\Album;

use League\Tactician\Bernard\QueueableCommand;
use Symfony\Component\Validator\Constraints as Assert;

class CreateAlbumCommand implements QueueableCommand
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $title;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $artistId;

    public function __construct($title, $artistId)
    {
        $this->title = $title;
        $this->artistId = $artistId;
    }

    /**
     * @return mixed
     */
    public function getArtistId()
    {
        return $this->artistId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return QueueableCommand::class;
    }
}