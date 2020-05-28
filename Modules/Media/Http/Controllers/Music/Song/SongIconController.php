<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Modules\Media\Models\Image\ImageFileProvider;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;

class SongIconController extends BaseController
{
    public function show($song)
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
                request()->get('width', 60),
                request()->get('height', 60));

//            return $response->generateResponse();
        } else
            return response()->json(['message' => 'Обложка не найдена'], 404);
    }
}
