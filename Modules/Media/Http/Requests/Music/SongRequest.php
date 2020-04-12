<?php


namespace Modules\Media\Http\Requests\Music;


use Modules\Shared\Http\Requests\BaseFormRequest;

class SongRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'nullable|string',
            'mp3File' => 'nullable|file',
            'coverImageFile' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $extensions = ['mp3', 'mpga'];
            $extension = request()->file('mp3File')->guessExtension() ?? request()->file('mp3File')->guessClientExtension();
            if (!in_array($extension, $extensions))
                $validator->errors()->add('mp4File', 'Only mp3 files are allowed');
        });
    }
}
