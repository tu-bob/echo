<?php


namespace Modules\Media\Models\Music;


use Modules\Media\Models\Artist\ArtistAlias;
use Modules\Media\Models\ExternalLink\ExternalLink;
use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Models\BaseModel;
use Modules\Shared\Models\Pivots\BasePivot;

/**
 * @property int play_count
 * @property int view_count
 * @property mixed songs
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

    public function externalLinks()
    {
        return $this->morphMany(ExternalLink::class, 'linkable');
    }

    public function updateArtistAliases()
    {
        $this->songs->load('artistAliases');

        $aliases = $this->songs->map(function ($song) {
            return $song->artistAliases;
        })->flatten();

        $uniqueAliases = [];

        foreach ($aliases as $alias) {
            if (isset($uniqueAliases[$alias->id])) {
                $uniqueAliases[$alias->id]['artist_songs_count'] = $uniqueAliases[$alias->id]['artist_songs_count'] + 1;
            } else {
                $uniqueAliases[$alias->id] = ['artist_songs_count' => 1];
            }
        }

        $this->artistAliases()->sync($uniqueAliases);
    }
}
