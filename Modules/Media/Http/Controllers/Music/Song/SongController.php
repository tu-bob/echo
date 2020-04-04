<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Illuminate\Support\Facades\Storage;
use Modules\Media\Http\Filters\Media\SongFilter;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;
use Modules\Shared\Http\Responses\FileResponse;

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
        $song = Song::with('audioFile')->findOrFail($song)->audioFile;

        $fileResponse = new FileResponse($song->path, $song->mime_type);
        return $fileResponse->generateResponse();
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
//        $filePath = null;
        $song = Song::with('coverImage')->findOrFail($song);
        $coverImage = $song->coverImage;
//        if ($coverImage)
//            $filePath = $song->coverImage->path;

        if (!$coverImage && request()->get('album')) {
            $album = $song->albums()->with('cover')
                ->has('cover')
                ->first();

            if ($album)
                $coverImage = $album->cover;
        }

        if ($coverImage) {
            $response = new FileResponse($coverImage->path, $coverImage->mime_type);
            return $response->generateResponse();
        } else
            return response()->json(['message'  => 'Обложка не найдена' ], 404);
    }
}
