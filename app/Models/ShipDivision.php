<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDivision extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function region(){
        return $this->belongsTo(ShipRegion::class,'region_id','id');
    }
}
