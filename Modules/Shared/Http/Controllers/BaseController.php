<?php

namespace Modules\Shared\Http\Controllers;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    protected float $stringMatchMinRate = 0.20;

    /**
     * @param Builder $query
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    protected function callGetOrPaginate(Builder $query)
    {
        if (request()->get('paginate'))
            return $query->paginate(request()->get('paginate'));
        else
            return $query->get();
    }

    protected function pagination()
    {
        return request()->get('paginate') ? request()->get('paginate') : 10;
    }
}
