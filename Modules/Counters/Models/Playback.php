<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 18.06.2020
 */

namespace Modules\Counters\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Media\Enum\PlaybackType;
use Modules\Shared\Models\BaseModel;

class Playback extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        Relation::morphMap([
            'songs' => 'Modules\Media\Models\Music\Song',
            'music_albums' => 'Modules\Media\Models\Music\MusicAlbum',
            'artists' => 'Modules\Media\Models\Artist\Artist'
        ]);
    }

    public static function getTopSongsByDate(Carbon $date)
    {
        return Playback::where('playable_type', PlaybackType::Song->value)
            ->where('created_at', '>', $date)
            ->limit(50)
            ->get();
    }
}
