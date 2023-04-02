<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $table = 'pharmacies';
    protected $primaryKey = "id";

    public function headquarter()
    {
       return $this->hasOne(Headquarter::class,'id','headquarter_id');
    }

    public function area()
    {
       return $this->hasOne(Area::class,'id','area_id');
    }
}
