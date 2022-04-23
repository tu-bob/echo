<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 * @copyright Copyright (c) 2022, coded.tj
 */

namespace Modules\Media\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Media\Enum\PlaylistType;
use Modules\Media\Models\Playlist;

class UpdateMusicalCharts implements ShouldQueue
{
    public function handle()
    {
        Playlist::createTopSongsPlaylist(Carbon::now()->subMonth(), PlaylistType::MusicMonthlyChart,"Топ месяца");
        Playlist::createTopSongsPlaylist(Carbon::now()->subWeek(), PlaylistType::MusicWeeklyChart,"Топ недели");
        Playlist::createTopSongsPlaylist(Carbon::now()->subDay(), PlaylistType::MusicDailyChart,"Топ дня");

    }
}
