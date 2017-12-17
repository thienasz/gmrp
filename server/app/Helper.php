<?php

/**
 * Created by PhpStorm.
 * User: thienth3
 * Date: 12/17/2017
 * Time: 6:18 PM
 */
class Helper
{
    public static function getDayReport(\Carbon\Carbon $time) {
        if(!$time) {
            return \Carbon\Carbon::now()->format("dd/mm/yyyy");
        }

        return $time->format("dd/mm/yyyy");
    }

    public static function getMonthReport(\Carbon\Carbon $time) {
        if(!$time) {
            return \Carbon\Carbon::now()->format("mm/yyyy");
        }

        return $time->format("mm/yyyy");
    }
}