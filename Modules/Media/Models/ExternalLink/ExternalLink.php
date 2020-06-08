<?php


namespace Modules\Media\Models\ExternalLink;


use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Shared\Models\BaseModel;

class ExternalLink extends BaseModel
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

    public $visible = ['id', 'resource', 'link', 'song_id'];
}
