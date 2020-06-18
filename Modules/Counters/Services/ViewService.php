<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 19.06.2020
 */

namespace Modules\Counters\Services;


use Modules\Counters\Dto\ViewDto;
use Modules\Counters\Interfaces\Viewable;
use Modules\Counters\Models\View;

class ViewService
{
    public function store(ViewDto $dto, Viewable $entity)
    {
        $entity->views()->save(new View($dto->toArray()));
    }
}
