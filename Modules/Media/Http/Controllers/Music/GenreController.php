<?php


namespace Modules\Media\Http\Controllers\Music;


use Modules\Media\Models\Music\Genre;
use Modules\Shared\Http\Controllers\BaseController;

class GenreController extends BaseController
{
    public function all()
    {
        return Genre::all();
    }

    public function getGenres()
    {
        return Genre::has('songs')->get();
    }
}
