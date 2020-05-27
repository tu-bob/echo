<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Illuminate\Support\Facades\Storage;
use Modules\Media\Http\Filters\Media\SongFilter;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Image\ImageFileProvider;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;
use Modules\Shared\Http\Responses\FileResponse;

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

//    public function getAudioFile(Song $song)
//    {
//        if (!request()->headers->get('referer')
//            || parse_url(request()->headers->get('referer'), PHP_URL_HOST) !== 'echo.tj')
//            abort(403);
//
//        if (!$song->audioFile)
//            return response()->json([], 404);
//
//        $range = $this->getByteRange();
//        if (!$range)
//            return redirect('app/songs/' . $song->id);
//        $range[1] = $range[0] + 200000;
//        $fileResponse = new FileResponse($song->audioFile->path, $song->audioFile->mime_type, $range);
//        return $fileResponse->generateResponse();
//    }

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

    public function countPlay(Song $song)
    {
        $song->play_count += 1;
        $song->save();
        return;
    }

    public function getIcon($song)
    {
//        $filePath = null;
        $song = Song::findOrFail($song);
        $coverImage = $song->cover_image_id;
//        if ($coverImage)
//            $filePath = $song->coverImage->path;

        if (!$coverImage && request()->get('album')) {
            $album = $song->albums()
                ->has('cover')
                ->first();

            if ($album)
                $coverImage = $album->cover_id;
        }

        if ($coverImage) {
            $imageProvider = new ImageFileProvider('cover');
            return $imageProvider->getResizedFileResponse(
                $coverImage,
                request()->get('width', 50),
                request()->get('height', 50));

//            return $response->generateResponse();
        } else
            return response()->json(['message' => 'Обложка не найдена'], 404);
    }
}
