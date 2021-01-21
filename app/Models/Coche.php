<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;
    protected $fillable=['modelo', 'color', 'kilometros', 'marca_id', 'foto'];
    public function marca(){
        //return $this->belongsTo(Marca::class)->withDefault(['nombre'=>'Sin Marca']);
        return $this->belongsTo(Marca::class);
    }
    //Scopes
    public function scopeMarca_id($query, $v){
        if($v=='%'){
            return $query->where('marca_id','like' ,$v)
            ->orWhereNull('marca_id');
        }
        if($v==-1){
            return $query->whereNull('marca_id');
        }
        if(!isset($v)){
            return $query->where('marca_id','like' ,'%')
            ->orWhereNull('marca_id');
        }
        return $query->where('marca_id', $v);
    }
    public function scopeKilometros($query, $v){
        if(!isset($v)) return $query->where('kilometros', 'like', '%');
        if($v=='%') return $query->where('kilometros', 'like', '%');
        if($v==1) return $query->where('kilometros', '<', '10000');
        if($v==2) return $query->where('kilometros', '>=', 10000)->where('kilometros', '<', '30000');
        if($v==3) return $query->where('kilometros', '>=', 30000)->where('kilometros', '<', '50000');
        if($v==2) return $query->where('kilometros', '>=', 50000);
    }
}
