<?php


namespace Modules\Media\Http\Filters\Media;


use Modules\Shared\Http\Filters\Filter;

class MusicAlbumFilter extends Filter
{
    public function filter()
    {
        parent::filter();

        if (isset($this->filters['songs'])) {
            $this->query->has('songs', '>=', $this->filters['songs']);
        }

        return $this->query;
    }
}
