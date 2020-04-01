<?php


namespace Modules\Media\Http\Controllers\Music;


use Modules\Media\Models\Music\MusicAlbum;
use Modules\Shared\Http\Controllers\BaseController;

class MusicAlbumSongController extends BaseController
{
    public function getSongs($album)
    {
//        $album = MusicAlbum::with('songs.artistAliases')->findOrFail($album);
//        $album->view_count += 1;
//        $album->save();
        return MusicAlbum::with('songs.artistAliases')->findOrFail($album)->songs;
    }
}
