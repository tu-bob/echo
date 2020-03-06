<?php


namespace Modules\Media\Libs\StringComparator;


use Modules\Media\Libs\StringComparator\Algorithms\DiceCoefficient;

class DiceBestMatchFinder extends BestMatchFinder
{

    function compare($needle, $string)
    {
        $comparator = new DiceCoefficient();
        return $comparator->compareStrings($needle, $string);
    }
}
