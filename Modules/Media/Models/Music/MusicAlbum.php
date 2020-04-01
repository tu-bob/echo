<?php


namespace Modules\Media\Models\Music;


use Modules\Media\Models\Artist\ArtistAlias;
use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Models\BaseModel;
use Modules\Shared\Models\Pivots\BasePivot;

/**
 * @property int play_count
 */
class MusicAlbum extends BaseModel
{
    public function songs()
    {
        return $this->belongsToMany(Song::class)
            ->using(BasePivot::class)
            ->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(MusicAlbumType::class);
    }

    public function cover()
    {
        return $this->belongsTo(ImageFile::class);
    }

    public function artistAliases()
    {
        return $this->belongsToMany(ArtistAlias::class)
            ->using(BasePivot::class)
            ->withPivot('artist_songs_count')
            ->withTimestamps();
    }
}
