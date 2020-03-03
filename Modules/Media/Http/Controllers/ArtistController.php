<?php


namespace Modules\Media\Http\Controllers;


use App\Http\Controllers\Controller;
use Modules\Media\Models\Artist\Artist;

class ArtistController extends Controller
{
    public function __construct()
    {
        //TODO middleware
    }

    public function store()
    {
        $data = request()->validate($this->rules);
        $artist = Artist::create(["name" => $data['name']]);

        $this->createAliases($artist, $data['aliases']);

        return $artist;
    }

    public function update(Artist $artist)
    {
        $data = request()->validate($this->rules);
        $artist->update(['name' => $data['name']]);

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

    private $rules = [
        'name' => 'required|string',
        'aliases' => 'nullable|array'
    ];
}
