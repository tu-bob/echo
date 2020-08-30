<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 15.07.2020
 */

namespace Modules\ImageGallery\Models;


use Modules\Shared\Models\BaseModel;

/**
 * @property string id
 * @property mixed path
 * @property mixed mime_type
 */
class Image extends BaseModel
{
    protected $table = 'image_files';
}
