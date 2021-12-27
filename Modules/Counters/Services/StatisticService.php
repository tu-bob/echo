<?php


namespace Modules\Counters\Services;


use App\Models\User\User;
use Carbon\Carbon;
use Modules\Counters\Models\Visitor;
use Modules\Media\Models\Music\Song;

class StatisticService
{
    public function getVisitorsCount():int {
        return Visitor::where('created_at', '>', Carbon::now()->subDays(7))->distinct('ip')->count();
    }

    public function getUsersCount():int {
        return User::count();
    }
    public function getSongsCount():int {
        return Song::count();
    }
}
