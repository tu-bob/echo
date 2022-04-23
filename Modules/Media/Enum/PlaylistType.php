<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 * @copyright Copyright (c) 2022, coded.tj
 */

namespace Modules\Media\Enum;

enum PlaylistType: int
{
    case Personal = 0;
    case MusicDailyChart = 11;
    case MusicWeeklyChart = 12;
    case MusicMonthlyChart = 13;
}
