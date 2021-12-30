<?php


namespace Modules\Media\Http\Filters;


use Illuminate\Http\Request;
use Modules\Media\Models\Artist\Artist;
use Spatie\QueryBuilder\QueryBuilder;

class ArtistQuery extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if (!$subject)
            $subject = Artist::query();

        parent::__construct($subject, $request);

        $this->allowedFilters( 'aliases.name');
    }
}
