<?php


namespace Modules\Media\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Media\Models\Music\MusicAlbumType;

class MusicAlbumTypeTableSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['Cast recording'],
            ['Compilation album'],
            ['Concept album'],
            ['Cover album'],
            ['Double album'],
            ['Exploito'],
            ['Extended play'],
            ['Greatest hits album'],
            ['Live album'],
            ['LP record'],
            ['Mini-LP'],
            ['Album musical'],
            ['Promotional album'],
            ['Remix album'],
            ['Sampler album'],
            ['Soundtrack album'],
            ['Single album'],
            ['Split album'],
            ['Spoken word album'],
            ['Studio album'],
            ['Tribute album']
        ];

        foreach ($types as $type) {
            MusicAlbumType::create([
                'name' => $type[0]
            ]);
        }
    }
}
