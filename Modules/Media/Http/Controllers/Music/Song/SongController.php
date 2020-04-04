<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Http\Filters\Media\SongFilter;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;

class SongController extends BaseController
{
    private $headers = [
        'Content-Type' => 'audio/mpeg',
        'Cache-Control' => "public, must-revalidate, max-age=0",
        'Pragma' => 'no-cache',
        'Accept-Ranges' => 'bytes',
        'Expires' => '0'
    ];

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
        $song = Song::with('audioFile')->findOrFail($song)->audioFile;
        $file = Storage::get($song->path);

        $headers = array_merge($this->headers, [
            'Content-Length' => Storage::size($song->path)
        ]);

        return (new Response($file, 200, $headers));
    }

    public function downloadSong($song)
    {
        $song = Song::with('audioFile')->findOrFail($song);
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

    public function countPlay(Song $song)
    {
        $song->play_count += 1;
        $song->save();
        return;
    }

    public function getIcon($song)
    {
        $song = Song::with('coverImage')->findOrFail($song);

        if ($song->coverImage)
            return Storage::get($song->coverImage->path);

        if (request()->get('album')) {
            $album = $song->albums()->with('cover')
                ->has('cover')
                ->first();

            if ($album)
                return Storage::get($album->cover->path);
        }

        return abort(404, 'Обложка песни не найдена');
    }
}
