<?php


namespace Modules\Media\Http\Controllers\Music;


use App\Http\Controllers\Controller;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreAudioFileRequestWriter;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Music\AudioFile;

class SongController extends Controller
{
    public function store(SongRequest $request)
    {
//        dd($request->all());
$all = $request->all();
        $tags = array(
            'artist'       => 'Daler Nazarov / Sultonazarov',
            'title'        => 'Biyoed',
            'album'        => 'In the garden',
//            'band'         => $request->band[$key],
//            'publisher'    => $request->publisher[$key],
//            'genre'        => $request->genre[$key],
            'year'         => '2000',
//            'track_number' => $request->track_number[$key],
//            'bpm'          => $request->bpm[$key],
//            'initial_key'  => $request->initial_key[$key],
        );

//        $editor = new AudioFileMetaData($all['mp3File']->path(), $tags);
//        $editor->mergeTags();
//        $editor->writeTags();

//        $file = new AudioFile();
//        $file->path  = $all['mp3File']->path();
//        $file->fetchTags();
//        $file->writeTags($tags);
//        $file->fetchTags($tags);
//        dd($file->tags);
//
//        $saver = new Mp3MetaDataEditor($all['mp3File'], null);

        $writer = new StoreSongRequestWriter($all);
        $writer->write();
    }
}
