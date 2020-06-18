<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 18.06.2020
 */

namespace Modules\Counters\Services;


use Modules\Counters\Dto\PlaybackDto;
use Modules\Counters\Interfaces\Playable;
use Modules\Counters\Models\Playback;

class PlaybackService
{
    public function store(PlaybackDto $dto, Playable $entity)
    {
        $entity->playbacks()->save(new Playback($dto->toArray()));
    }
}
