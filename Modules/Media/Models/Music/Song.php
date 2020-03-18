<?php


namespace Modules\Media\Models\Music;


use Modules\Media\Models\Artist\ArtistAlias;
use Modules\Shared\Models\BaseModel;
use Modules\Shared\Models\Pivots\BasePivot;

class Song extends BaseModel
{
    protected $casts = [
        'lyrics' => 'string'
    ];

    public function audioFile()
    {
        return $this->belongsTo(AudioFile::class);
    }

    public function artistAliases()
    {
        return $this->belongsToMany(ArtistAlias::class)
            ->using(BasePivot::class)
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class)
            ->using(BasePivot::class)
            ->withTimestamps();
    }

    public function albums()
    {
        return $this->belongsToMany(MusicAlbum::class)
            ->using(BasePivot::class)
            ->withTimestamps();
    }
}
