<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 30.08.2020
 */

namespace Modules\Media\Http\Controllers\Music\Album;


use Modules\ImageGallery\Services\ImageService;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Shared\Http\Controllers\BaseController;

class MusicAlbumCoverController extends BaseController
{
    private ImageService $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function show(MusicAlbum $album){
        return $this->service->show($album->cover_id,
            collect([
                'fit' => [
                    'width' => request()->get('width', 400),
                    'height' => request()->get('height', 400)
                ]
            ]),
            true
        );
    }
}
