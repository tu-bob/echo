<?php


namespace Modules\Media\Http\Requests\Music;


use Illuminate\Foundation\Http\FormRequest;

class MusicAlbumRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'nullable|string',
            'mp3File' => 'nullable|file|mimes:jpeg,jpg,png',
            'title' => 'required|string',
            'year' => 'required|string',
            'songs.*' => 'required|exists:songs,id'
        ];
    }
}
