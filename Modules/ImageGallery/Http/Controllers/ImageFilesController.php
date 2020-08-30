<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Http\Controllers;


use App\Http\Controllers\Controller;
use Modules\FileSystem\Http\Responses\FileResponse;
use Modules\ImageGallery\Libs\DirectoryProviders\DirectoryProviderFabric;
use Modules\ImageGallery\Models\Image;
use Modules\ImageGallery\Services\ImageService;
use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;

class ImageFilesController extends Controller
{
    private ImageService $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;

        $this->middleware('auth')->only('store');
    }

    public function show($image)
    {
        $options = null;
        if (request()->get('width') || request()->get('height'))
            $options = collect([
                'fit' => [
                    'width' => request()->get('width'),
                    'height' => request()->get('height')
                ]
            ]);
        return $this->service->show($image, $options, true);
    }

    public function store()
    {
        $rules = [
            'images' => 'required|array',
            'images.*' => 'required|mimes:jpg,jpeg,png,gif',
            'type' => 'required|string'
        ];

        $data = request()->validate($rules);


        $images = [];

        foreach ($data['images'] as $file) {
            $fabric = new DirectoryProviderFabric();
            $images[] = $this->service->store($file, $fabric->create($data['type']));
        }

        return $images;
    }
}
