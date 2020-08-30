<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 30.08.2020
 */

namespace Modules\ImageGallery\Libs\DirectoryProviders;


use Modules\ImageGallery\Interfaces\DirectoryProvider;

class OtherImageDirProvider implements DirectoryProvider
{

    public function getDirectory()
    {
        return 'images/other';
    }
}
