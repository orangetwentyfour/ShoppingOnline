<?php
/**
 * Created by PhpStorm.
 * User: duy21
 * Date: 11/25/2018
 * Time: 2:14 AM
 */

function money($price)
{
    $result = [];
    $length = strlen($price);
    $tmpPrice = $price;
    while ($length - 3 > 0) {
        $result[] = substr($tmpPrice, $length - 3, 3);
        $tmpPrice = substr($tmpPrice, 0, $length - 3);
        $length -= 3;
    }
    $result[] = $tmpPrice;
    $result = array_reverse($result);
    return join('.', $result);
}

if (!function_exists('constants')) {
    function constants($key)
    {
        return config('constants.' . $key);
    }
}
