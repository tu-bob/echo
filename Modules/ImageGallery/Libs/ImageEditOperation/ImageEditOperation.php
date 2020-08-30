<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Libs\ImageEditOperation;


use Intervention\Image\Image;

interface ImageEditOperation
{
    public function execute(string $path): Image;
}
