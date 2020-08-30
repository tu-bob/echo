<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Libs\ImageEditOperation;


use Intervention\Image\Image;
use Intervention\Image\Facades\Image as ImageFacade;

class MakeImageOperation implements ImageEditOperation
{

    public function execute(string $path): Image
    {
        return ImageFacade::make($path);
    }
}
