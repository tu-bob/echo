<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Illuminate\Support\Facades\Storage;
use Modules\Media\Http\Filters\Media\SongFilter;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;

class SongController extends BaseController
{
    public function __construct()
    {
        $admin = [
            'store'
        ];

        $this->middleware('auth')->only($admin);
    }

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
        return Song::with(['artistAliases', 'genres', 'albums.cover', 'albums.artistAliases', 'clip', 'externalLinks'])
            ->findOrFail($song);
    }

    public function downloadSong(Song $song)
    {
        if (!$song->audioFile)
            return response()->json(['message' => 'Файл не найден'], 404);

        if (!$song->allow_download)
            return response()->json(['message' => 'Доступ запрещен'], 403);

        $song->download_count += 1;
        $song->save();

        return Storage::download($song->audioFile->path, "{$song->formatted_name}.mp3");
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

}
