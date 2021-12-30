<?php


namespace Modules\Blog\Filters;


use Illuminate\Http\Request;
use Modules\Blog\Models\Post\Post;
use Spatie\QueryBuilder\QueryBuilder;

class PostQuery extends QueryBuilder
{
    public function __construct($subject = null, ?Request $request = null)
    {
        if (!$subject)
            $subject = Post::query();

        parent::__construct($subject, $request);

        $this->allowedFilters('title', 'author.name');
    }

}
