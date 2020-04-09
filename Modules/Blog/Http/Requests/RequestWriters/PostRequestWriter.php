<?php


namespace Modules\Blog\Http\Requests\RequestWriters;


use DOMDocument;
use HTMLPurifier_Config;
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

    //TODO check article
    private function prepareData()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.SafeIframe', true);
        $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%'); //allow YouTube and Vimeo
        $config->set('HTML.AllowedElements',
            ['iframe',
                'a',
                'p',
                'table',
                'tbody',
                'tr',
                'td',
                'img',
                'h1',
                'h2',
                'h3',
                'h4',
                'h5',
                'h6',
                'ul',
                'ol',
                'li',
                'span',
                'b',
                'i',
                'u',
                'pre',
                'blockquote']);
        $config->set('HTML.AllowedAttributes',
            'iframe@src,iframe@allowfullscreen,img@src,width,height,alt');

        $config->set('HTML.ForbiddenAttributes',
            'iframe@width,iframe@height');

        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('iframe', 'allowfullscreen', 'Bool');

        $purifier = new \HTMLPurifier($config);

        $article = $this->editHtml($purifier->purify($this->request['article']));

        $data = [
            'title' => $this->request['title'],
            'slug' => Str::slug($this->request['title']),
            'author_id' => Author::firstOrCreate(['name' => $this->request['author']])->id,
            'annotation' => $this->request['annotation'],
            'post_category_id' => $this->request['category'],
            'article' => $article,
//            'article' => $this->request['article'],
            'reference' => isset($this->request['reference']) ? $this->request['reference'] : null,
            'ref_name' => isset($this->request['ref_name']) ? $this->request['ref_name'] : null
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

    private function editHtml($html)
    {
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
        $document = new DOMDocument();
        $document->loadHTML($html);
        $iframes = $document->getElementsByTagName('iframe');

        foreach ($iframes as $iframe) {
            $wrapper = $document->createElement('div');
            $wrapper->setAttribute('class', 'embed-responsive embed-responsive-16by9');
            $frame = $document->createElement('iframe');
            $frame->setAttribute('allowfullscreen', 'allowfullscreen');
            $frame->setAttribute('class', 'embed-responsive-item');
            $frame->setAttribute('src', $iframe->getAttribute('src'));
            $wrapper->appendChild($frame);
            $iframe->parentNode->replaceChild($wrapper, $iframe);
        }

        return mb_convert_encoding($document->saveHTML(), 'UTF-8', 'HTML-ENTITIES');
    }
}
