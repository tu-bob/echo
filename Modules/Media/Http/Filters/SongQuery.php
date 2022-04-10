<?php


namespace Modules\Media\Http\Filters;


use Illuminate\Http\Request;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Filters\LatestSort;
use Modules\Shared\Filters\RandomSort;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class SongQuery extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if (!$subject)
            $subject = Song::query();

        parent::__construct($subject, $request);

        $this->allowedFilters('title', 'artistAliases.name', 'genres.id');

        $this->allowedSorts(
            AllowedSort::custom('random', new RandomSort()),
            AllowedSort::custom('latest', new LatestSort()),
        );
    }
}
