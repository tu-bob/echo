<?php


namespace Modules\Media\Http\Controllers\Music;


use Modules\Media\Libs\StringComparator\DiceBestMatchFinder;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Media\Models\Music\MusicAlbumType;
use Modules\Shared\Http\Controllers\BaseController;

class MusicAlbumController extends BaseController
{
    public function filter()
    {
        $aliases = MusicAlbum::all();
        $finder = new DiceBestMatchFinder(request()->get('title'), $aliases->all(), 'title');
        $matches = $finder->findBestMatches($this->stringMatchMinRate);

        return array_map(function ($match) {
            return $match->entity;
        }, $matches);
    }

    public function getAlbumTypes()
    {
        return MusicAlbumType::all();
    }
}
