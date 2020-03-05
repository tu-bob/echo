<?php


namespace App\Libs\Helpers;


class CamelCaseConverter
{
    static function convertSnakeToCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    static function convertCamelToSnakeCase($string)
    {
        $str = preg_replace('/([a-z])([A-Z])/', "\\1_\\2", $string);
        $str = strtolower($str);
        return $str;
    }
}
