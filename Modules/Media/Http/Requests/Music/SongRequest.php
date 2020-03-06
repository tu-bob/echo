<?php


namespace Modules\Media\Http\Requests\Music;


use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'nullable|string',
            'mp3File' => 'nullable|file|mimetypes:audio/mpeg',
            'title' => 'required|string',
            'year' => 'required|string',
            'label' => 'nullable|string',
            'artistAliases' => 'required|array',
            'artistAliases.*' => 'required|exists:artist_aliases,id',
            'genres.*' => 'required|exists:genres,id'
        ];
    }
}
