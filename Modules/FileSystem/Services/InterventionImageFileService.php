<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\FileSystem\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Modules\Shared\Libs\Random;

class InterventionImageFileService extends FileService
{
    public function store(Image $file, string $rootPath, string $entityClass, string $extension = 'jpg',
                          string $filename = 'noname', int $quality = 100, string $disk = 'local')
    {
        $encoded = $file->encode($extension, $quality);
        $entity = new $entityClass();
        $entity->hash = hash('sha256', $encoded);
        $entity->mime_type = $file->mime;
        $entity->original_filename = $filename;
        $entity->extension = $extension;

        $path = $rootPath . '/' . Random::generateString(3);

        $entity->filename = $this->createFileName($path, $extension);
        $entity->path = $path. '/' . $entity->filename;
        Storage::disk($disk)->put($entity->path, $encoded);
        $entity->save();

        return $entity;
    }
}
