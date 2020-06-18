<?php
/**
 *
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru> on 19.06.2020
 */

namespace Modules\Media\Http\Controllers\Music\Song;


use Modules\Counters\Dto\PlaybackDto;
use Modules\Counters\Services\PlaybackService;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Controllers\BaseController;
use Wolfcast\BrowserDetection;

class SongPlaybackController extends BaseController
{
    public function store(Song $song)
    {
        $song->play_count += 1;
        $song->save();

        $service = new PlaybackService();
        $service->store(new PlaybackDto([
            'ip' => request()->ip(),
            'device' => request()->header('User-Agent')
        ]), $song);

        return;
    }
}
