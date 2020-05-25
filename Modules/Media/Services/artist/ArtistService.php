<?php


namespace Modules\Media\Services\artist;


use Illuminate\Http\UploadedFile;
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
        $artist = Artist::create([
            'type' => isset($data['type']) ? $data['type'] : null
        ]);

        $aliasService = new ArtistAliasService($artist);
        $aliasService->createAliases(collect($data['aliases']));

        if (isset($data['avatarFile']))
            $this->saveAvatar($artist, $data['avatarFile']);

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
        $aliasService->updateAliases($data);

        $artist->update([
            'type' => isset($data['type']) ? $data['type'] : null
        ]);

        if (isset($data['avatarFile']))
            $this->saveAvatar($artist, $data['avatarFile']);

        return $artist;
    }

    private function saveAvatar(Artist $artist, UploadedFile $avatar)
    {
        $avatarService = new AvatarService();
        $artist->avatar_id = $avatarService->store($avatar)->id;
        $artist->save();
    }

}
