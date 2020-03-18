<?php


namespace Modules\Media\Libs\Request\FileRequest\Saver;


use App\Libs\Helpers\StringHelpers\RandomStringGenerator;
use App\Libs\Ulid\Ulid;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileSaver
{
    private UploadedFile $file;

    private string $dirPath;

    private string $hash;

    private string $entityClass;

    private string $userId;


    public function __construct(UploadedFile $file, string $dirPath, string $entityClass, string $userId)
    {
        $this->file = $file;
        $this->dirPath = $dirPath;
        $this->entityClass = $entityClass;
        $this->userId = $userId;
    }

    function findOrCreateFile()
    {
        $this->hash = hash('sha256', file_get_contents($this->file->path()));
//        $existingFile = $this->entityClass::where('hash', $this->hash)->first();
//        if ($existingFile)
//            return $existingFile;
//        else
        return $this->createFile();
    }

    function createFile()
    {
        $entity = new $this->entityClass();
        $entity->hash = $this->hash;
        $entity->mime_type = $this->file->getMimeType();
        $entity->extension = $this->file->getClientOriginalExtension();
        $entity->uploaded_by_id = $this->userId;

        $path = $this->dirPath . '/' . RandomStringGenerator::generate(3);

        $entity->filename = $this->createFileName($path);
        $entity->path = Storage::disk('local')->putFileAs($path, $this->file, $entity->filename);
        $entity->save();

        return $entity;
    }

    public function createFileName($path)
    {
        $generator = new Ulid();
        $fileName = $generator->generate() . '.' . $this->file->getClientOriginalExtension();

        if (Storage::disk('local')->exists($path . '/' . $fileName)) {
            return $this->createFileName($path);
        } else return $fileName;
    }
}
