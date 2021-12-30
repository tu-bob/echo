<?php


namespace Modules\Media\Http\Filters;


use Illuminate\Http\Request;
use Modules\Media\Models\Music\MusicAlbum;
use Spatie\QueryBuilder\QueryBuilder;

class MusicAlbumQuery extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if (!$subject)
            $subject = MusicAlbum::query();

        parent::__construct($subject, $request);

        $this->allowedFilters( 'title','artistAliases.name');
    }
}
