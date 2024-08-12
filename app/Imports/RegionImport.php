<?php

namespace App\Imports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionImport implements ToArray, WithHeadingRow,WithChunkReading
{
      /**
    * @param ToArray $array
    */
    public function array(array $data)
    {
        try {
           
           foreach ($data as $key => $region) {
                   Region::create([
                      "nom"=>$region['nom'],
                      /*"latitude"=>$region['latitude'],
                      "longitude"=>$region['longitude']*/
                      
                  ]);
                }
              
          } catch (\Exception $e) {
              dd($e);
              // Gérez l'erreur
          } 
    }
    public function chunkSize():int{
        return 1;
      }
}
