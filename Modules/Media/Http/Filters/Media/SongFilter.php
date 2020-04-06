<?php


namespace Modules\Media\Http\Filters\Media;


use Modules\Shared\Http\Filters\Filter;

class SongFilter extends Filter
{
    public function filter()
    {
        parent::filter();

        if (isset($this->filters['genres'])) {
            $genres = explode(',', $this->filters['genres']);
            $this->query->whereHas('genres', function ($query) use ($genres) {
                $query->whereIn('genre_id', $genres);
            });
        }

        return $this->query;
    }
}
