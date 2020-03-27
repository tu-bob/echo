<?php


namespace Modules\Blog\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Blog\Models\Post\PostCategory;

class PostCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Новости',
            'Музыка',
            'Путешествие'
        ];

        foreach ($categories as $category) {
            PostCategory::create([
                'name' => $category
            ]);
        }
    }
}
