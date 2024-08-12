<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListeDepartemental implements  ToArray, WithHeadingRow
{
    public function array(array $data)
    {
        /* $regions=DB::table("regions")->get();
         foreach ($data as $key => $departement) {
            foreach ($regions as $key1 => $region) {
                if($departement["region"]==$region->nom){
                    Departement::create([
                        "nom"=>$departement['departement'],
                        "region_id"=>$region->id,
                    ]);
                }
            }

        } */
       return $data;
    }    
}
