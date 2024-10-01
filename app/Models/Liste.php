<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',"type"
    ];
    public function validationDepartemental()
    {
        return $this->hasOne(ValidationDepartemental::class);
    }
    public function validationNational()
    {
        return $this->hasOne(ValidationNational::class);
    }
}
