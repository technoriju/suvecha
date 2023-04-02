<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockist extends Model
{
    use HasFactory;
    protected $table = 'stockists';
    protected $primaryKey = "id";

    public function headquarter()
    {
       return $this->hasOne(Headquarter::class,'id','headquarter_id');
    }

    public function area()
    {
       return $this->hasOne(Area::class,'id','area_id');
    }

    // public function pharmacy()
    // {
    //     return $this->hasOne(Pharmacy::class,'id','pharmacy_id');
    // }

    // public function specialization()
    // {
    //     return $this->hasOne(Specialization::class,'id','specialization_id');
    // }
}
