<?php


namespace Modules\Shared\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    protected array $filters;

    protected Builder $query;

    public function __construct(array $filters, Builder $query)
    {
        $this->filters = $filters;
        $this->query = $query;
    }

    /**
     * @return Builder $query
     */
    function filter()
    {
        if (isset($this->filters['order']) && $this->filters['order'] === 'latest')
            $this->query->latest();

        return $this->query;
    }
}
