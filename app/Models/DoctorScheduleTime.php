<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorScheduleTime extends Model
{
    use HasFactory;
    protected $table = 'doctor_schedule_times';
    protected $primaryKey = "id";

    // public function doctortime()
    // {
    //     return $this->hasMany(DoctorTime::class,'id','doctor_time_id');
    // }

}
