<?php


namespace Modules\Media\Http\Controllers\Artist;

use Illuminate\Validation\Rule;
use Modules\Media\Models\Artist\Artist;
use Modules\Media\Services\artist\ArtistService;
use Modules\Shared\Http\Controllers\BaseController;

class ArtistController extends BaseController
{
    private ArtistService $service;

    public function __construct(ArtistService $service)
    {
        $admin = [
            'store',
            'update'
        ];

        $this->middleware('auth')->only($admin);

        $this->service = $service;
    }

    public function store()
    {
        return $this->service->store(request()->validate($this->rules()));
    }

    public function update(Artist $artist)
    {
        return $this->service->update($artist, request()->validate($this->rules()));
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
            'type' => 'nullable|string',
            'info' => 'nullable|string',
            'aliases' => 'required|array',
            'aliases.*' => [
                'required',
                'string'
            ],
            'avatarFile' => 'nullable|file|mimes:jpeg,jpg,png|max:1024|dimensions:max_width=500,max_height=500',
        ];
    }
}
