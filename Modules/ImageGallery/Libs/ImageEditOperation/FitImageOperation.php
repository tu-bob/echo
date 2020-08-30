<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Libs\ImageEditOperation;


use Intervention\Image\Image;
use Intervention\Image\Facades\Image as ImageFacade;

class FitImageOperation extends EditOperation
{
    private ?int $width;

    private ?int $height;

    public function __construct(ImageEditOperation $operation, ?int $width, ?int $height)
    {
        parent::__construct($operation);

        $this->width = $width;

        $this->height = $height;
    }

    public function execute(string $path): Image
    {
        return ImageFacade::make($path)->fit($this->width, $this->height, function ($constraint) {
            $constraint->upsize();
        });
    }
}
