<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 18.06.2020
 */

namespace Modules\Counters\Models;


use Illuminate\Database\Eloquent\Relations\Relation;
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
}
