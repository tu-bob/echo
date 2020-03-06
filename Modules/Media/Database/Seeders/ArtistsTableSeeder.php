<?php


namespace Modules\Media\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Media\Models\Artist\Artist;

class ArtistsTableSeeder extends Seeder
{
    public function run()
    {
        $artistData = [
            ['Coldplay'],
            ['Далер Назаров', 'Daler Nazarov']
        ];

        foreach ($artistData as $artistAliases){
            $artist = Artist::create();

            foreach ($artistAliases as $alias){
                $artist->aliases()->create([
                    'name' => $alias
                ]);
            }
        }
    }
}
