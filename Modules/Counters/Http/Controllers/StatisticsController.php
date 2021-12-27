<?php

namespace Modules\Counters\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Counters\Services\StatisticService;

class StatisticsController extends Controller
{
    private StatisticService $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function overall(){
        return [
            'visitors' => $this->statisticService->getVisitorsCount(),
            'users' => $this->statisticService->getUsersCount(),
            'songs' => $this->statisticService->getSongsCount()
        ];
    }

}
