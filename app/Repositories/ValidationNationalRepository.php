<?php
namespace App\Repositories;

use App\Models\ValidationNational;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class ValidationNationalRepository extends RessourceRepository{
    public function __construct(ValidationNational $validationNational){
        $this->model = $validationNational;
    }

   

}
