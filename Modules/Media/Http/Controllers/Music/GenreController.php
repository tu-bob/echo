<?php


namespace Modules\Media\Http\Controllers\Music;


use App\Http\Controllers\Controller;
use Modules\Media\Models\Music\Genre;

class GenreController extends Controller
{
    public function all()
    {
        return Genre::all();
    }
}
