<?php


namespace Modules\Media\Libs\Request\FileRequest\Saver;


use App\Libs\Helpers\StringHelpers\RandomStringGenerator;
use App\Libs\Ulid\Ulid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileSaver
{
    private UploadedFile $file;

    private string $dirPath;

    private string $hash;

    private string $entityClass;


    public function __construct(UploadedFile $file, string $dirPath, string $entityClass)
    {
        $this->file = $file;
        $this->dirPath = $dirPath;
        $this->entityClass = $entityClass;
        $this->hash = hash('sha256', file_get_contents($file->path()));
    }

    public function findOrSaveFile(\Closure $closure = null)
    {
        $query = $this->entityClass::where('hash', $this->hash);

        if ($closure)
            $query = $closure($query);

        $existingFile = $query->first();
        if ($existingFile)
            return $existingFile;
        else
            return $this->saveFile();
    }

    public function saveFile()
    {
        $entity = new $this->entityClass();
        $entity->hash = $this->hash;
        $entity->mime_type = $this->file->getMimeType();
        $entity->original_filename = $this->file->getClientOriginalName();
        $entity->extension = $this->file->getClientOriginalExtension();

        $path = $this->dirPath . '/' . RandomStringGenerator::generate(3);

        $entity->filename = $this->createFileName($path);
        $entity->path = Storage::disk('local')->putFileAs($path, $this->file, $entity->filename);
        $entity->save();

        return $entity;
    }

    private function createFileName($path)
    {
        $generator = new Ulid();
        $fileName = $generator->generate() . '.' . $this->file->getClientOriginalExtension();

        if (Storage::disk('local')->exists($path . '/' . $fileName)) {
            return $this->createFileName($path);
        } else return $fileName;
    }
}
