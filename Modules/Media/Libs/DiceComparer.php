<?php


namespace Modules\Media\Libs;


class DiceComparer
{
    function compare($string1, $string2)
    {
        if (empty($string1) || empty($string2))
            return 0;

        if ($string1 == $string2)
            return 1;

        $strlen1 = strlen($string1);
        $strlen2 = strlen($string2);

        if ($strlen1 < 2 || $strlen2 < 2)
            return 0;

        $length1 = $strlen1 - 1;
        $length2 = $strlen2 - 1;

        $matches = 0;
        $i = 0;
        $j = 0;

        while ($i < $length1 && $j < $length2)
        {
            $a = substr($string1, $i, 2);
            $b = substr($string2, $j, 2);
            $cmp = strcasecmp($a, $b);

            if ($cmp == 0)
                $matches += 2;

            ++$i;
            ++$j;
        }

        return $matches / ($length1 + $length2);
    }
}
