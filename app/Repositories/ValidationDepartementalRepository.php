<?php
namespace App\Repositories;

use App\Models\ValidationDepartemental;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class ValidationDepartementalRepository extends RessourceRepository{
    public function __construct(ValidationDepartemental $ValidationDepartemental){
        $this->model = $ValidationDepartemental;
    }



}
