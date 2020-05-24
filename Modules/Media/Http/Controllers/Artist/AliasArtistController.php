<?php


namespace Modules\Media\Http\Controllers\Artist;


use Modules\Media\Models\Artist\Artist;

class AliasArtistController
{
    public function show(Artist $artist)
    {
        $artist->load('aliases');
        $artist->setAppends(['albums', 'songs']);
        return $artist;
    }
}
