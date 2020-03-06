<?php


namespace Modules\Media\Http\Controllers\Artist;


use App\Http\Controllers\Controller;
use Modules\Media\Libs\StringComparator\DiceBestMatchFinder;
use Modules\Media\Models\Artist\ArtistAlias;

class ArtistAliasController extends Controller
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
