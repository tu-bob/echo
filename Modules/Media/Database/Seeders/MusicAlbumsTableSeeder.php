<?php


namespace Modules\Media\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Media\Models\Music\MusicAlbum;

class MusicAlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MusicAlbum::create([
            'title' => 'Parachutes'
        ]);
    }
}
