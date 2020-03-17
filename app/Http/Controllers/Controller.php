<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
