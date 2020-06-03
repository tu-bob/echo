<?php


namespace Modules\Media\Http\Requests\Music;


use Illuminate\Foundation\Http\FormRequest;

class MusicAlbumRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'nullable|string',
            'albumCoverFile' => 'nullable|file|mimes:jpeg,jpg,png|max:1024|dimensions:min_width=512,min_height=512',
            'title' => 'required|string',
            'year' => 'required|string',
            'songs.*' => 'required|exists:songs,id',
            'type' => 'required|exists:music_album_types,id',
            'links' => 'nullable|array'
        ];
    }
}
