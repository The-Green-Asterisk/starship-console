<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiceController extends Controller
{
    public static function d4(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 4);
        }

        return $inArray ? $dice : array_sum($dice);
    }

    public static function d6(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 6);
        }

        return $inArray ? $dice : array_sum($dice);
    }

    public static function d8(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 8);
        }

        return $inArray ? $dice : array_sum($dice);
    }

    public static function d10(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 10);
        }

        return $inArray ? $dice : array_sum($dice);
    }

    public static function d12(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 12);
        }

        return $inArray ? $dice : array_sum($dice);
    }

    public static function d20(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 20);
        }

        return $inArray ? $dice : array_sum($dice);
    }

    public static function d100(int $number, $inArray = false)
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++) {
            $dice[] = rand(1, 100);
        }

        return $inArray ? $dice : array_sum($dice);
    }
}
