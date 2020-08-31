<?php


namespace Modules\Shared\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    protected array $filters;

    protected Builder $query;

    protected array $complexOrder = ['latest', 'random'];

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
                $orderArray = explode(':', $order);
                if (isset($orderArray[1]) && $orderArray[1] === 'desc')
                    $this->query->orderByDesc($orderArray[0]);
                else
                    $this->query->orderBy($orderArray[0]);
            }
        }
    }

    protected function handleComplexOrder(string $order)
    {
        if ($order === 'latest')
            $this->query->latest();
        if ($order === 'random')
            $this->query->inRandomOrder();
    }

    protected function applyLimit()
    {
        if (isset($this->filters['limit']))
            $this->query->limit($this->filters['limit']);
    }
}
