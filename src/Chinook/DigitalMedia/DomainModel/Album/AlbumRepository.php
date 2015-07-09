<?php

namespace Chinook\DigitalMedia\DomainModel\Album;

interface AlbumRepository
{
    public function add(Album $anAlbum);
}