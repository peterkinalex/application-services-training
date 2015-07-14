<?php

namespace Chinook\DigitalMedia\Application\Album;

use League\Tactician\Bernard\QueueableCommand;

class ChangeNameCommand implements QueueableCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $newName;

    /**
     * ChangeNameCommand constructor.
     *
     * @param int $id
     * @param string $newName
     */
    public function __construct($id, $newName)
    {
        $this->id = $id;
        $this->newName = $newName;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNewName()
    {
        return $this->newName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return QueueableCommand::class;
    }


}