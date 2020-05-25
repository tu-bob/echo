<?php


namespace Modules\Media\Services\artist;


use Modules\Media\Models\Artist\Artist;
use Modules\Media\Services\image\AvatarService;

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
        $aliasService->createAliases(collect($data['aliases']));

        $avatarService = new AvatarService();
        $artist->avatar_id = $avatarService->store($data['avatarFile'])->id;
        $artist->save();
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
