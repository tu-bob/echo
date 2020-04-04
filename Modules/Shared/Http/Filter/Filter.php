<?php


namespace Modules\Shared\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    protected array $filters;

    protected Builder $query;

    protected array $complexOrder = ['latest'];

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
        $this->applyOrder();

        $this->applyLimit();

        return $this->query;
    }

    protected function tryParseOrderByFilter()
    {
        if (isset($this->filters['order']))
            $this->filters['order'] = explode(',', $this->filters['order']);
        else  $this->filters['order'] = [];
    }

    protected function applyOrder()
    {
        $this->tryParseOrderByFilter();

        foreach ($this->filters['order'] as $order) {
            if (in_array($order, $this->complexOrder)) {
                $this->handleComplexOrder($order);
            } else {
                $direction = explode(':', $order);
                if (isset($direction[1]) && $direction[1] === 'desc')
                    $this->query->orderBy($order);
                else
                    $this->query->orderBy($order);
            }
        }
    }

    protected function handleComplexOrder(string $order)
    {
        if ($order === 'latest')
            $this->query->latest();
    }

    protected function applyLimit()
    {
        if (isset($this->filters['limit']))
            $this->query->limit($this->filters['limit']);
    }
}
