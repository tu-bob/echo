<?php

namespace Modules\Media\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Counters\Models\Playback;
use Modules\Media\Enum\PlaylistableType;
use Modules\Media\Enum\PlaylistType;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Models\BaseModel;
use Modules\Shared\Pivots\BaseMorphPivot;

class Playlist extends BaseModel
{
    protected static function boot()
    {
        Relation::morphMap([
            PlaylistableType::Song->value => Song::class
        ]);

        parent::boot();
    }

    public function songs(): MorphToMany
    {
        return $this->morphToMany(Song::class, 'playlistable', 'playlistables', 'playlist_id', 'playlistable_id')
            ->using(BaseMorphPivot::class);
    }

    public static function createTopSongsPlaylist(Carbon $date, PlaylistType $type, string $name)
    {
        Playback::getTopSongsByDate($date)
//            ->groupBy('playable_id')
//            ->sortByDesc(function ($playbacks) {
//                return count($playbacks);
//            })->keys()
//            ->pipe(function ($songsIds) {
//                return Song::whereIn('id', $songsIds)->get();
//            })
            ->pipe(function ($songs) use ($type, $name) {
                $playlist = Playlist::create([
                    'type' => $type->value,
                    'name' => $name
                ]);
                $playlist->songs()->attach($songs);
            });
    }
}
