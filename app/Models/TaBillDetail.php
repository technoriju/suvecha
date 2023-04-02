<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaBillDetail extends Model
{
    use HasFactory;
    protected $table = 'ta_bill_details';
    protected $primaryKey = "id";

    // public function setAreaIdAttribute($value)
    // {
    //     $this->attributes['area_id'] = implode(',',$value);
    // }
}
