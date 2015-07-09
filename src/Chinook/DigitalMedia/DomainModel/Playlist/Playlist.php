<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="Playlist", uniqueConstraints={@ORM\UniqueConstraint(name="IPK_Playlist", columns={"PlaylistId"})})
 * @ORM\Entity
 */
class Playlist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PlaylistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    private $name;


}
