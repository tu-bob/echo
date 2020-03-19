<?php


namespace Modules\Media\Http\Controllers\Music;


use Illuminate\Support\Facades\Storage;
use Modules\Media\Http\Requests\Music\MusicAlbumRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreMusicAlbumRequestWriter;
use Modules\Media\Libs\StringComparator\DiceBestMatchFinder;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Media\Models\Music\MusicAlbumType;
use Modules\Shared\Http\Controllers\BaseController;

class MusicAlbumController extends BaseController
{
    public function store(MusicAlbumRequest $request)
    {
        $writer = new StoreMusicAlbumRequestWriter($request->all());
        $writer->write();
    }

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

    public function getAlbums()
    {
        $query = MusicAlbum::where('created_by_id', auth()->user()->id);
        return $this->callGetOrPaginate($query);
    }

    public function getAlbum($album)
    {
        return MusicAlbum::with(['songs', 'type'])->findOrFail($album);
    }

    public function getCover($album)
    {
        $cover = MusicAlbum::findOrFail($album)->cover;
        return Storage::get($cover->path);
    }
}
