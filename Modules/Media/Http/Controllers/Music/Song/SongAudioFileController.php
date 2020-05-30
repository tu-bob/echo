<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;
use Modules\Shared\Http\Responses\FileResponse;

class SongAudioFileController extends BaseController
{
    public function show(Song $song)
    {
//        if (!request()->headers->get('referer')
//            || parse_url(request()->headers->get('referer'), PHP_URL_HOST) !== 'echo.tj')
//            return redirect('app/songs/' . $song->id);

        if (!$song->audioFile)
            return response()->json([], 404);

        $range = $this->getByteRange();
        if (!$range)
            return redirect('app/songs/' . $song->id);
        $range[1] = $range[0] + 300000;
        $fileResponse = new FileResponse($song->audioFile->path, $song->audioFile->mime_type, $range);
        return $fileResponse->generateResponse();
    }
}
