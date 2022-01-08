<?php


namespace Modules\Media\Http\Filters;


use Illuminate\Http\Request;
use Modules\Media\Models\Video\Video;
use Spatie\QueryBuilder\QueryBuilder;

class VideoQuery extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if (!$subject)
            $subject = Video::query();

        parent::__construct($subject, $request);

        $this->allowedFilters('title', 'type');
    }
}
