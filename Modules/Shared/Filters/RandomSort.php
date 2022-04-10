<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 * @copyright Copyright (c) 2022, coded.tj
 */

namespace Modules\Shared\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class RandomSort implements Sort
{

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $query->inRandomOrder();
    }
}
