<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $primaryKey = "id";

    public function pharmacy()
    {
        return $this->hasOne(Pharmacy::class,'id','pharmacy_id');
    }

    public function specialization()
    {
        return $this->hasOne(Specialization::class,'id','specialization_id');
    }

    public function setPharmacyIdAttribute($value)
    {
        $this->attributes['pharmacy_id'] = implode(',',$value);
    }

}
