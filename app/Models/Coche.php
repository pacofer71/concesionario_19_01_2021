<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;
    protected $fillable=['modelo', 'color', 'kilometros', 'marca_id', 'foto'];
    public function marca(){
        return $this->belongsTo(Marca::class);
    }
}
