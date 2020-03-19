<?php


namespace Modules\Media\Http\Controllers\Artist;

use Illuminate\Validation\Rule;
use Modules\Media\Models\Artist\Artist;
use Modules\Shared\Http\Controllers\BaseController;

class ArtistController extends BaseController
{
    public function __construct()
    {
        //TODO middleware
    }

    public function store()
    {
        $data = request()->validate($this->rules());
        $artist = Artist::create();

        $this->createAliases($artist, $data['aliases']);

        return $artist;
    }

    public function update(Artist $artist)
    {
        $data = request()->validate($this->rules());
        $aliases = array();

        $deletedAliases = $artist->aliases->filter(function ($alias) use ($data) {
            return !in_array($alias->name, $data['aliases']);
        });

        foreach ($deletedAliases as $alias) {
            //TODO check if there are songs that using this alias
            $alias->delete();
        }
        $newAliases = [];
        foreach ($data['aliases'] as $alias) {
            $exists = $artist->aliases->first(function ($item) use ($alias) {
                return $item->name === $alias;
            });

            if (!$exists) $newAliases[] = $alias;
        }

        $this->createAliases($artist, $newAliases);

        return $artist;
    }

    private function createAliases($artist, $aliases)
    {
        $createdAliases = [];
        foreach ($aliases as $alias) {
            $createdAliases[] = $artist->aliases()->create(['name' => $alias]);
        }

        return $createdAliases;
    }

    public function getArtist(Artist $artist)
    {
        return $artist;
    }

    public function getArtists()
    {
        $query = Artist::latest();
        return $this->callGetOrPaginate($query);
    }

    private function rules()
    {
        return [
            'id' => 'nullable|string',
            'aliases' => 'required|array',
            'aliases.*' => [
                'required',
                'string',
                Rule::unique('artist_aliases', 'name')->where(function ($query) {
                    return $query->where('artist_id', '!=', request()->get('id'));
                })
            ]
        ];
    }
}
