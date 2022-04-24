<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 * @copyright Copyright (c) 2022, coded.tj
 */

namespace Modules\Media\Http\Controllers\Chart;

use Modules\Media\Enum\PlaylistType;
use Modules\Media\Models\Playlist;
use Modules\Shared\Http\Controllers\BaseController;

class MusicalChartController extends BaseController
{
    public function getMonthlyTop(){
        return Playlist::latest()->with('songs.artistAliases')->where('type', PlaylistType::MusicMonthlyChart->value)->first();
    }

    public function getWeeklyTop(){
        return Playlist::latest()->with('songs.artistAliases')->where('type', PlaylistType::MusicWeeklyChart->value)->first();
    }

    public function getDailyTop(){
        return Playlist::latest()->with('songs.artistAliases')->where('type', PlaylistType::MusicDailyChart->value)->first();
    }
}
