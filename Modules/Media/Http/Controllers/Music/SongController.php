<?php


namespace Modules\Media\Http\Controllers\Music;


use App\Http\Controllers\Controller;
use Modules\Media\Http\Requests\Music\SongRequest;

class SongController extends Controller
{
    public function store(SongRequest $request){
        dd($request->all());
    }
}
