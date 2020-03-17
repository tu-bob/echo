<?php


namespace Modules\Media\Http\Controllers\Music;


use App\Http\Controllers\Controller;
use Modules\Media\Http\Requests\Music\SongRequest;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreAudioFileRequestWriter;
use Modules\Media\Libs\Request\RequestWriter\Music\StoreSongRequestWriter;
use Modules\Media\Models\Music\AudioFile;
use Modules\Media\Models\Music\Song;

class SongController extends Controller
{
    public function store(SongRequest $request)
    {
        $writer = new StoreSongRequestWriter($request->all());
        $writer->write();
    }

    public function getSongs()
    {
        $query = Song::where('uploaded_by_id', auth()->user()->id)->with('artistAliases');
        return $this->callGetOrPaginate($query);
    }

    public function getSong($song){
        return Song::with(['artistAliases', 'genres', 'albums'])->findOrFail($song);
    }
}
