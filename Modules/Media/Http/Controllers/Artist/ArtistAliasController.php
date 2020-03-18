<?php


namespace Modules\Media\Http\Controllers\Artist;


use Modules\Media\Libs\StringComparator\DiceBestMatchFinder;
use Modules\Media\Models\Artist\ArtistAlias;
use Modules\Shared\Http\Controllers\BaseController;

class ArtistAliasController extends BaseController
{
    public function filter()
    {
        $aliases = ArtistAlias::all();
        $finder = new DiceBestMatchFinder(request()->get('name'), $aliases->all(), 'name');
        $matches = $finder->findBestMatches($this->stringMatchMinRate);

        return array_map(function ($match) {
            return $match->entity;
        }, $matches);
    }
}
