<?php

namespace App\Helpers;
use Illuminate\Support\Str;

/**
 * Class APIHelper.
 */
class APIHelper
{
    /**
     * formate Sort Query param for endpoints.
     * @param string  $sortParam
     * @return string
     */
    public static function formatSort($sortParams, $collections)
    {   
        if (Str::contains($sortParams, '*')) {
            $sortOptions = explode('*', $sortParams);
        
            $sorted = $collections->sortBy($sortOptions[0]);

            $collections = $sorted->values()->all();

            return $collections;

        }

        if (Str::contains($sortParams, '-')) {
            $sortOptions = explode('-', $sortParams);

            $sorted = $collections->sortByDesc($sortOptions[0]);

            $collections = $sorted->values()->all();

            return $collections;
        }

        return $collections;
    }
    
    /**
     * formate coordinate string.
     * @param string  $coordinates
     * @return array
     */
    public static function formatCoordinates($coordinates)
    {   
        $Formattedcoordinates = [];
        
        $formateCoo = json_decode($coordinates);
        if (!empty($formateCoo)) {
            $Formattedcoordinates['latitude'] = $formateCoo[0];
            $Formattedcoordinates['longitude'] = $formateCoo[1];
        }

        return $Formattedcoordinates;
    }

    /**
     * formate coordinate string.
     * @param string  $coordinates
     * @return array
     */
    public static function formatMultiCoordinates($coordinates)
    {   
        $Formattedcoordinates = [];
        $formateCoo = json_decode($coordinates);
        if (!empty($formateCoo) && count($formateCoo) > 1) {
            foreach ($formateCoo as $key1 => $value1) {
                if ($key1 === 0) {
                    $Formattedcoordinates['start'] = $value1;
                }
                if ($key1 === 1) {
                    $Formattedcoordinates['end'] = $value1;
                }
            }
            $Formattedcoordinates['start']['latitude'] = $Formattedcoordinates['start'][0];
            $Formattedcoordinates['start']['longitude'] = $Formattedcoordinates['start'][1];
            $Formattedcoordinates['end']['latitude'] = $Formattedcoordinates['end'][0];
            $Formattedcoordinates['end']['longitude'] = $Formattedcoordinates['end'][1];
            unset($Formattedcoordinates['start'][0]);
            unset($Formattedcoordinates['start'][1]);
            unset($Formattedcoordinates['end'][0]);
            unset($Formattedcoordinates['end'][1]);
        }

        return $Formattedcoordinates;
    }

    /**
     * formate delited comma separatted values.
     * @param string  $string
     * @return array
     */
    public static function formatDelimmiter($string)
    {
        $formattedArray = [];

        if (Str::contains($string, 'not')) {
            $replaced = Str::replaceFirst('not', '', $string);
            $formatted = explode(',', trim($replaced, "[]"));
            $formattedArray['exclude'] = $formatted;
        } else {
            $formattedArray = explode(',', trim($string, "[]"));
        }

        return $formattedArray;
    }

    /**
     * formate range params values.
     * @param string  $string
     * @return array
     */
    public static function formatRange($string)
    {
        return explode('-', $string);
    }

    /**
     * formate referenceCode.
     * @param string  $codes
     * @return array
     */
    public static function formatRefCodes($codes)
    {
        return explode(',', $codes);
    }
}