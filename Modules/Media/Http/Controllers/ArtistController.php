<?php


namespace Modules\Media\Http\Controllers;


use App\Http\Controllers\Controller;
use Modules\Media\Models\Artist\Artist;
use Modules\Media\Models\Artist\ArtistAlias;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

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

        $aliases = array();
        foreach ($data['aliases'] as $alias) {
            $aliases[] = $artist->aliases()->create(['name' => $alias]);
        }
    }

    private $rules = [
        'name' => 'required|string',
        'aliases' => 'nullable|array'
    ];
}
