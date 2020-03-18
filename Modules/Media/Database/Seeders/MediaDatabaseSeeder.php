<?php

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MediaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ArtistsTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(MusicAlbumTypeTableSeeder::class);
        $this->call(MusicAlbumsTableSeeder::class);
    }
}
