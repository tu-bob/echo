<?php


namespace Modules\Media\Models\Image;


class ImageFileDirProvider
{
    private string $type;

    /**
     * ImageFileDirProvider constructor.
     * @param string $type of image: blog, cover, etc.
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string path to directory
     */
    public function getDirectory()
    {
        switch ($this->type) {
            case 'blog':
                return 'images/blog';
            case 'albumCover':
                return 'images/cover';
            default:
                return 'images/public';
        }
    }
}
