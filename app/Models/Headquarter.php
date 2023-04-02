<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    use HasFactory;
    protected $table = 'headquarters';
    protected $primaryKey = "id";

    public function district()
    {
        return $this->hasOne(DistrictList::class,'id','district_id');
    }
}
