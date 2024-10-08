<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom','region_id','nb','is_diaspora'
    ];
    public function region(){
        return $this->belongsTo(Region::class);
    } 
   
}

