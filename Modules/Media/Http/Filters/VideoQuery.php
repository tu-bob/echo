<?php


namespace Modules\Media\Http\Filters;


use Illuminate\Http\Request;
use Modules\Media\Models\Video\Video;
use Modules\Shared\Filters\LatestSort;
use Modules\Shared\Filters\RandomSort;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class VideoQuery extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if (!$subject)
            $subject = Video::query();

        parent::__construct($subject, $request);

        $this->allowedFilters('title', 'type');

        $this->allowedSorts(
            AllowedSort::custom('random', new RandomSort()),
            AllowedSort::custom('latest', new LatestSort()),
        );
    }
}
