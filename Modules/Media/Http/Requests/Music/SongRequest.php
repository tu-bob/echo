<?php


namespace Modules\Media\Http\Requests\Music;


use Modules\Shared\Http\Requests\BaseFormRequest;

class SongRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'nullable|string',
            'mp3File' => 'nullable|file|mimetypes:audio/mpeg',
            'coverImageFile' => 'nullable|file|mimes:jpg,jpeg,png',
            'title' => 'required|string',
            'year' => 'required|string',
            'label' => 'nullable|string',
            'artistAliases' => 'required|array',
            'artistAliases.*' => 'required|exists:artist_aliases,id',
            'genres.*' => 'required|exists:genres,id',
            'lyrics' => 'nullable|string',
            'clip_src' => 'nullable|url'
        ];
    }
}
