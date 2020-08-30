<?php


namespace Modules\Media\Http\Controllers\Music\Song;


use Modules\ImageGallery\Services\ImageService;
use Modules\Media\Models\Image\ImageFileProvider;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;

class SongIconController extends BaseController
{
    private ImageService $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

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
            return $this->service->show($coverImage, collect([
                    'fit' => [
                        'width' => request()->get('width', 52),
                        'height' => request()->get('height', 52)
                    ]
                ])
            );
            
        } else
            return response()->json(['message' => 'Обложка не найдена'], 404);
    }
}
