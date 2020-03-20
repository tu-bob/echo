<?php


namespace Modules\Blog\Http\Requests\RequestWriters;


use Illuminate\Support\Str;
use Modules\Blog\Models\Author\Author;
use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Http\Requests\RequestWriter;

class PostRequestWriter extends RequestWriter
{

    private ImageFile $previewImage;

    function write()
    {
        if (isset($this->request['previewImage']))
            $this->saveFile();

        $data = $this->prepareData();

        $this->createOrUpdate($data);

        return $this->entity;
    }

    private function prepareData()
    {
        $data = [
            'title' => $this->request['title'],
            'slug' => Str::slug($this->request['title']),
            'author_id' => Author::firstOrCreate(['name' => $this->request['author']])->id,
            'annotation' => $this->request['annotation'],
            'article' => $this->request['article'],
            'reference' => $this->request['reference'],
            'ref_name' => $this->request['ref_name'],
        ];

        if (isset($this->previewImage))
            $data['preview_image_id'] = $this->previewImage->id;

        return $data;
    }

    private function saveFile()
    {
        $saver = new ImageFileSaver($this->request['previewImage'], 'blog');
        $this->previewImage = $saver->saveFile();
    }
}
