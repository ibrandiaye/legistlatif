<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ListeNational implements ToArray, WithHeadingRow
{
    public function array(array $data)
    {
       return $data;
    }    
}
