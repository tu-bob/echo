<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\FileSystem\Services;


use Illuminate\Support\Facades\Storage;
use Modules\Shared\Libs\Ulid\Ulid;

abstract class FileService
{
    protected function createFileName($path, $extension)
    {
        $generator = new Ulid();
        $fileName = $generator->generate() . '.' . $extension;

        if (Storage::disk('local')->exists($path . '/' . $fileName)) {
            return $this->createFileName($path, $extension);
        } else return $fileName;
    }
}
