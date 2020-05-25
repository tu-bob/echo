<?php


namespace Modules\Media\Services\artist;


use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\Media\Models\Artist\Artist;

class ArtistAliasService
{
    private Artist $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @param $data
     * @return mixed
     */
    function updateAliases($data) : EloquentCollection
    {
        $this->artist->aliases->filter(function ($alias) use ($data) {
            return !in_array($alias->name, $data['aliases']) && $alias->songs->count() === 0;
        })->each(function ($aliasToDelete) {
            $aliasToDelete->delete();
        });

        return collect($data['aliases'])->diff(
            $this->artistActiveAliases()->pluck('name')
        )->pipe(function ($newAliases) {
            return $this->createAliases($newAliases);
        })->merge($this->artistActiveAliases());
    }

    /**
     * @return EloquentCollection
     */
    private function artistActiveAliases() : EloquentCollection
    {
        return $this->artist->aliases->whereNull('deleted_at');
    }

    public function createAliases(Collection $aliases)
    {
        return $aliases->unique()->map(function ($alias) {
            return $this->artist->aliases()->create(['name' => $alias]);
        });
    }
}
