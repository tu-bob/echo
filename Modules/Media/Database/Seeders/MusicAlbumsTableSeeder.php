<?php


namespace Modules\Media\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Media\Models\Music\MusicAlbumType;

class MusicAlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $albums = [
            'Parachutes',
            'Parachutes Jap',
            'Parachutes Japanese',
            'Japanese',
        ];

        foreach ($albums as $album) {
            MusicAlbum::create([
                'title' => $album,
                'type_id' => MusicAlbumType::where('name', 'Album musical')->first()->id,
                'year' => '2018'
            ]);
        }
    }
}
