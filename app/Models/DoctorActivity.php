<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorActivity extends Model
{
    use HasFactory;
    protected $table = 'doctor_activities';
    protected $primaryKey = "id";

    public function setMedicineIdAttribute($value)
    {
        $this->attributes['medicine_id'] = implode(',',$value);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class,'id','doctor_id');
    }
}
