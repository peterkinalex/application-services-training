<?php

namespace Chinook\DigitalMedia\DomainModel\Album;

interface AlbumRepository
{
    public function add(Album $anAlbum);

    /**
     * @param int $id
     *
     * @return Album
     */
    public function ofId($id);

    /**
     * @param Album $album
     */
    public function remove($album);
}