<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaBill extends Model
{
    use HasFactory;
    protected $table = 'ta_bills';
    protected $primaryKey = "id";

    public function headquarter()
    {
       return $this->hasOne(Headquarter::class,'id','headquarter_id');
    }

    public function area()
    {
       return $this->hasOne(Area::class,'id','area_id');
    }

    // public function setHeadquarterIdAttribute($value)
    // {
    //     $this->attributes['headquarter_id'] = implode(',',$value);
    // }
}
