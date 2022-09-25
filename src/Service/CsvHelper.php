<?php

namespace App\Service;

class CsvHelper
{
    public function __construct()
    {
      
    }


    public static function createFile($columns)
    {
        $handle = fopen('php://output', 'r+');

        fputcsv($handle, $columns);
        return $handle;
    }

    public static function calculateAvg($values)
    {
        $sum = array_sum($values);
        return round($sum/count($values),2);
    }
}