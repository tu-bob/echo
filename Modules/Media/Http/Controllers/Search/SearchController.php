<?php


namespace Modules\Media\Http\Controllers\Search;


use Modules\Media\Models\Music\MusicAlbum;
use Modules\Media\Models\Music\Song;
use Modules\Media\Models\Video\Video;
use Modules\Shared\Http\Controllers\BaseController;

class SearchController extends BaseController
{
    public function search($needle)
    {
        $songs = Song::where('title', 'like', "%{$needle}%")->with('artistAliases')
            ->orWhereHas('artistAliases', function ($query) use ($needle) {
                $query->where('name', 'like', "%{$needle}%");
            })->limit(10)->get();
//        $artist = ArtistAlias::where('name', 'like', "%{$query}%")->limit(10)->get();
        $albums = MusicAlbum::with('artistAliases')->where('title', 'like', "%{$needle}%")
            ->orWhereHas('artistAliases', function ($query) use ($needle) {
                $query->where('name', 'like', "%{$needle}%");
            })->limit(10)->get();

        $videos = Video::where('title', 'like', "%{$needle}%")->limit(10)->get();

        return response()->json([
            'songs' => $songs,
            'albums' => $albums,
            'videos' => $videos
        ], 200);
    }
}
