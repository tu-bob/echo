<?php


namespace Modules\Media\Services\artist;


use Illuminate\Support\Collection;
use Modules\Media\Models\Artist\Artist;
use Modules\Media\Models\Artist\ArtistAlias;

class ArtistService
{
    /**
     * @param array $data
     * @return Artist
     */
    public function store(array $data): Artist
    {
        $artist = Artist::create();
        $aliasService = new ArtistAliasService($artist);
        $artist->aliases = $aliasService->createAliases(collect($data));

        return $artist;
    }

    /**
     * @param Artist $artist
     * @param array $data
     * @return Artist
     */
    public function update(Artist $artist, array $data): Artist
    {

        $aliasService = new ArtistAliasService($artist);
        $artist->aliases = $aliasService->updateAliases($data);

        return $artist;
    }


}
