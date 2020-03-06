<?php


namespace Modules\Media\Http\Controllers\Music;


use App\Http\Controllers\Controller;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Mp3MetaData;
use Modules\Media\Libs\StringComparator\DiceBestMatchFinder;
use Modules\Media\Models\Music\Genre;

class SongController extends Controller
{
    public function store(SongRequest $request){
        $meta = new Mp3MetaData($request->file('file')->path());

        $genres = Genre::all();

        $finder = new DiceBestMatchFinder('olkroc', $genres->all(), 'name');

        $res = $finder->findBestMatch();

        dd($res->entity);
    }
}
