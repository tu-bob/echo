<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 16.07.2020
 */

namespace Modules\ImageGallery\Services;


use Intervention\Image\Image;
use Modules\ImageGallery\Libs\ImageEditOperation\EditOperation;
use Modules\ImageGallery\Libs\ImageEditOperation\MakeImageOperation;
use Modules\ImageGallery\Libs\ImageEditOperation\FitImageOperation;

class ImageEditService
{
    public function edit(string $path, array $options): Image
    {
        $operations = $this->getEditOperations($options);
        return $operations->execute($path);
    }

    private function getEditOperations(array $options): EditOperation
    {
        $decorator = new EditOperation(new MakeImageOperation());

        if (isset($options['fit']))
            $decorator = new FitImageOperation($decorator, $options['fit']['width'], $options['fit']['height']);

        return $decorator;
    }
}
