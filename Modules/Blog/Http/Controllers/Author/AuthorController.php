<?php


namespace Modules\Blog\Http\Controllers\Author;


use Modules\Blog\Models\Author\Author;
use Modules\Media\Libs\StringComparator\DiceBestMatchFinder;
use Modules\Shared\Http\Controllers\BaseController;

class AuthorController extends BaseController
{
    public function filter()
    {
        $authors = Author::all();
        $finder = new DiceBestMatchFinder(request()->get('name'), $authors->all(), 'name');
        $matches = $finder->findBestMatches($this->stringMatchMinRate);

        return array_map(function ($match) {
            return $match->entity;
        }, $matches);
    }
}
