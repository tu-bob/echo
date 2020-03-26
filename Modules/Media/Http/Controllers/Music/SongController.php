<?php


namespace Modules\Media\Http\Controllers\Music;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Http\Filters\Media\SongFilter;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;

class SongController extends BaseController
{
    public function store(SongRequest $request)
    {
        $writer = new StoreSongRequestWriter($request->all());
        $writer->write();
    }

    public function getSongs()
    {
        $query = Song::with('artistAliases');
        $filter = new SongFilter(request()->all(), $query);
        return $this->callGetOrPaginate($filter->filter());
    }

    public function getSong($song)
    {
        return Song::with(['artistAliases', 'genres', 'albums'])->findOrFail($song);
    }

    public function getAudioFile($song)
    {
        $file = Song::findOrFail($song)->audioFile;
        return Storage::get($file->path);
    }

    public function findSongsByInfo($info)
    {
        return Song::with('artistAliases')
            ->where('title', 'like', '%' . $info . '%')
            ->orWhereHas('artistAliases', function (Builder $query) use ($info) {
                $query->where('name', 'like', '%' . $info . '%');
            })
            ->get();
    }
}
