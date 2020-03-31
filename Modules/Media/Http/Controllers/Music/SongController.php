<?php


namespace Modules\Media\Http\Controllers\Music;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
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
        return Song::with(['artistAliases', 'genres', 'albums', 'clip'])->findOrFail($song);
    }

    public function getAudioFile($song)
    {
        $song = Song::findOrFail($song)->audioFile;
        $file = Storage::get($song->path);

        $headers = [
            'Content-Type' => 'audio/mpeg',
            'Cache-Control' => " public, must-revalidate, max-age=0",
            'Pragma' => 'no-cache',
            'Accept-Ranges' => 'bytes',
            'Content-Length' => Storage::size($song->path),
//            '"Content-Range' => 'bytes 0-',
//            'Content-Disposition' => 'inline; filename=audio',
            'Expires' => '0',
        ];
        return (new Response($file, 200, $headers));
    }

    public function findSongsByInfo($info)
    {
        return Song::with('artistAliases')
            ->where('title', 'like', '%' . $info . '%')
            ->orWhereHas('artistAliases', function ($query) use ($info) {
                $query->where('name', 'like', '%' . $info . '%');
            })
            ->get();
    }

    public function getIcon($song)
    {
        $song = Song::with('coverImage')->findOrFail($song);

        if ($song->coverImage)
            return Storage::get($song->coverImage->path);

        if (request()->get('album')) {
            $album = $song->albums()->with('cover')
                ->whereHas('cover')
                ->whereHas('songs', function (Builder $query) use ($song) {
                    $query->where('song_id', $song);
                })
                ->first();

            if ($album)
                return Storage::get($album->cover->path);
        }

        return abort(404, 'Обложка песни не найдена');
    }
}
