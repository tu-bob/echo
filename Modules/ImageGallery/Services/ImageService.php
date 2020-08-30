<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 15.07.2020
 */

namespace Modules\ImageGallery\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\FileSystem\Http\Responses\FileResponse;
use Modules\FileSystem\Services\InterventionImageFileService;
use Modules\ImageGallery\Interfaces\DirectoryProvider;
use Modules\ImageGallery\Models\Image;

class ImageService
{
    private InterventionImageFileService $fileService;

    private ImageEditService $editService;

    public function __construct(InterventionImageFileService $fileService, ImageEditService $editService)
    {
        $this->fileService = $fileService;

        $this->editService = $editService;
    }

    public function store(UploadedFile $file, DirectoryProvider $provider, array $editOptions = []): Image
    {
        $image = $this->editService->edit($file->getRealPath(), $editOptions);
        return $this->fileService->store($image, $provider->getDirectory(), Image::class);
    }

    public function show(string $id, ?Collection $editOptions = null, bool $cache = false)
    {
        $image = Image::findOrFail($id);

        if ($editOptions && $editOptions->count() > 0) {
            $cacheFolder = 'cache/' . $this->getCacheFolder($editOptions);

            if (Storage::exists($cacheFolder . $image->path)) {
                return $this->generateResponse($cacheFolder . $image->path, $image->mime_type);
            } else {
                $editedImg = $this->editService->edit(storage_path("app/{$image->path}"), $editOptions->all());

                if ($cache)
                    Storage::disk('local')->put(
                        $cacheFolder . $image->path,
                        $editedImg->encode(null, $editOptions->get('quality', 100))
                    );

                return $editedImg->response($image->extension);
            }
        }

        return $this->generateResponse($image->path, $image->mime_type);
    }

    private function getCacheFolder(Collection $options)
    {
        return $options->sortKeys()->keys()->reduce(function ($path, $option) use ($options) {
            return $path . $option . implode($options[$option]) . '/';
        });
    }

    private function generateResponse($path, $mime)
    {
        $response = new FileResponse($path, $mime);
        return $response->generateResponse();
    }
}
