<?php


namespace Modules\Media\Models\Image;

/**@deprecated */
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
            case 'cover':
                return 'images/cover';
            case 'avatar':
                return 'images/avatar';
            default:
                return 'images/public';
        }
    }
}
