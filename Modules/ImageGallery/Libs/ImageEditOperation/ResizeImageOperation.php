<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Libs\ImageEditOperation;


use Intervention\Image\Image;
use Intervention\Image\Facades\Image as ImageFacade;

class ResizeImageOperation implements ImageEditOperation
{

    private int $width;

    private int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;

        $this->height = $height;
    }

    public function execute(string $path): Image
    {
        ImageFacade::make($path)->resize($this->width, $this->height);
    }
}
