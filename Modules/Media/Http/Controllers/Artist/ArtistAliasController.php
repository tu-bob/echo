<?php


namespace Modules\Media\Http\Controllers\Artist;


use App\Http\Controllers\Controller;
use Modules\Media\Models\Artist\ArtistAlias;

class ArtistAliasController extends Controller
{
    public function filter()
    {
        return ArtistAlias::where('name', 'like', '%' . request()->get('name') . '%')->get();
    }
}
