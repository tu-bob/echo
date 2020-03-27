<?php


namespace Modules\Blog\Http\Controllers\Category;


use Modules\Blog\Models\Post\PostCategory;

class PostCategoryController
{
    public function getCategories()
    {
        return PostCategory::all();
    }
}
