<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = "id";

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function setHeadquarterIdAttribute($value)
    {
        $this->attributes['headquarter_id'] = implode(',',$value);
    }
}
