<?php


namespace Modules\Blog\Http\Controllers\Artist;


use App\Http\Controllers\Controller;
use Modules\Media\Models\Artist\Artist;

class ArtistController extends Controller
{
    private $rules = [
        'name' => 'required|string',
        'aliases' => 'nullable|array',
    ];

    public function index(){
        return 2;
    }

    public function store(){
        $data = request()->validate($this->rules);

        dd($data);
        $artist = Artist::create([
            'name' => $data->name
        ]);

    }
}
