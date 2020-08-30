<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 30.08.2020
 */

namespace Modules\ImageGallery\Libs\DirectoryProviders;


use Modules\ImageGallery\Interfaces\DirectoryProvider;

class DirectoryProviderFabric
{

    public function create($type): DirectoryProvider
    {
        switch ($type) {
            case 'blog':
                return new BlogImageDirProvider();
            default:
                return new OtherImageDirProvider();
        }
    }
}
