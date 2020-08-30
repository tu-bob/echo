<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 15.07.2020
 */

namespace Modules\FileSystem\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Shared\Libs\Random;

class UploadedFileService extends FileService
{
    public function store(UploadedFile $file, string $rootPath, string $entityClass, string $disk = 'local')
    {
        $entity = new $entityClass();
        $entity->hash = hash('sha256', file_get_contents($file->path()));
        $entity->mime_type = $file->getMimeType();
        $entity->original_filename = $file->getClientOriginalName();
        $entity->extension = $file->getClientOriginalExtension();

        $path = $rootPath . '/' . Random::generateString(3);

        $entity->filename = $this->createFileName($path, $file->getClientOriginalExtension());
        $entity->path = Storage::disk($disk)->putFileAs($path, $file, $entity->filename);
        $entity->save();

        return $entity;
    }
}
