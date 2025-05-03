<?php
// app/Traits/FormatsIndianCurrency.php

namespace App\Traits;

trait FormatsIndianCurrency
{
    public function formatIndianCurrency($number)
    {
        $number = (int) $number; // Ensure it's an integer
        $no = floor($number);
        $lastThree = substr($no, -3);
        $restUnits = substr($no, 0, -3);

        $restUnits = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $restUnits);

        return $restUnits !== '' ? $restUnits . ',' . $lastThree : $lastThree;
    }
}
