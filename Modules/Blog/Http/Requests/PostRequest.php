<?php


namespace Modules\Blog\Http\Requests;


use Modules\Shared\Http\Requests\BaseFormRequest;

class PostRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'nullable|string',
            'previewImage' => 'nullable|file|mimes:jpg,jpeg,png',
            'category' => 'required|exists:post_categories,id',
            'title' => 'required|string',
            'author' => 'required|string',
            'annotation' => 'required|string',
            'article' => 'required|string',
            'reference' => 'nullable|string',
            'ref_name' => 'nullable|string'
        ];
    }
}
