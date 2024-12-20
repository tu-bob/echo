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
     * @param int $limit
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    protected function callGetOrPaginate($query)
    {
        if (request()->get('paginate'))
            return $query->paginate(request()->get('paginate'));
        else {
            $limit = request()->get('limit') ?? 30;
            return $query->limit($limit)->get();
        }

    }

    protected function getPagination()
    {
        return request()->get('paginate') ? request()->get('paginate') : 10;
    }

    protected function getByteRange()
    {
        if (request()->header('Range')) {
            $range = explode('=', request()->header('Range'))[1];
            $range = explode('-', $range);
            $range[0] = (int)$range[0];
            $range[1] = $range[1] ? (int)$range[1] : null;
            return $range;
        } else return null;
    }
}
