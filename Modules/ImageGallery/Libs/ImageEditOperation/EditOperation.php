<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Libs\ImageEditOperation;

use Intervention\Image\Image;

/**
 * Base decorator for image editing
 */
class EditOperation implements ImageEditOperation
{
    protected ImageEditOperation $operation;

    public function __construct(ImageEditOperation $operation)
    {
        $this->operation = $operation;
    }

    public function execute(string $path): Image
    {
        return $this->operation->execute($path);
    }
}
