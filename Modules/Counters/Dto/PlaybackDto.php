<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 19.06.2020
 */

namespace Modules\Counters\Dto;


use Spatie\DataTransferObject\DataTransferObject;

class PlaybackDto extends DataTransferObject
{
    public ?string $ip;
    public ?string $device;
}
