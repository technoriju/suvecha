<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTime extends Model
{
    use HasFactory;
    protected $table = 'doctor_times';
    protected $primaryKey = "id";

    public function schedule()
    {
        return $this->hasMany(DoctorScheduleTime::class,'doctor_time_id','id');
    }

}
